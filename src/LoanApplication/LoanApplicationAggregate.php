<?php

declare(strict_types=1);

namespace LoanApplication;

use http\Exception\RuntimeException;
use LoanApplication\Events\LoadApplicationApproved;
use Ramsey\Uuid\UuidInterface;

class LoanApplicationAggregate implements AggregateInterface
{

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var LoanApplicationState
     */
    private $loanApplication;

    private $brokenRules = [];

    private $version = 0;

    private $pendingEvents = [];

    /**
     * LoanApplicationAggregate constructor.
     * @param LoanApplicationState $loanApplication
     */
    public function __construct(LoanApplicationState $loanApplication)
    {
        $this->loanApplication = $loanApplication;
    }

    public static function startApplication(UuidInterface $id, string $email, string $firstName, string $lastName)
    {
        return new self(
          new LoanApplicationState(
              $id,
              'draft',
              $firstName,
              $lastName,
              $email
          )
        );
    }

    public static function createFromHistory(\Iterator $events)
    {
        $self = new self();
        foreach ($events as $event) {
            $self->apply($event);
        }
    }

    private function apply(EventInterface $event)
    {
        $this->version++;
        if ($event instanceof LoanApplicationSubmitted) {
            $this->whenLoanApplicationSubmitted($event);
        } elseif ($event instanceof LoadApplicationApproved) {
            $this->whenLoanApplicationApproved($event);
        }
    }

    public function submitApplication()
    {
        if ($this->loanApplication->getStatus() != 'draft') {
            throw new \RuntimeException("application is not in draft state");
        }

        $this->publish( new LoanApplicationSubmitted($this->loanApplication->getId()));
    }

    private function whenLoanApplicationSubmitted(LoanApplicationSubmitted $event): void
    {
        $this->loanApplication->setState('Submitted');
    }


    public function withdraw(): void
    {
        $this->loanApplication->setState('Withdraw');
        $this->publish(new LoanApplicationWidrawed($this->loanApplication->getId()));
    }

    public function acceptOffer(Int $offerId): void
    {
        $status = $this->loanApplication->getStatus();

        if ($status != 'Offered') {
            $this->brokenRules[] = 'Cannot accept offer';
        }

        if (in_array($offerId, $this->loanApplication->offers)) {
            $this->brokenRules[] = 'Invalid offer';
        }

        if (count($this->brokenRules)) {
            return;
        }
    }

    public function approve(): void
    {
        if ($this->loanApplication->getStatus() != 'Submitted') {
            $this->loanApplication->setState('Can only approve a submitted application');
        }

        $this->publish(new LoadApplicationApproved($this->loanApplication->getId()));
    }

    private function whenLoanApplicationApproved(LoadApplicationApproved $event) {
        $this->loanApplication->setState('Approved');
    }

    public function publish(EventInterface $event) {
        $this->pendingEvents[] = $event;
        $this->apply($event);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getBrokenRules(): array
    {
        return $this->brokenRules;
    }

    /**
     * @return LoanApplicationState
     */
    public function getState(): LoanApplicationState
    {
        return $this->loanApplication;
    }
}