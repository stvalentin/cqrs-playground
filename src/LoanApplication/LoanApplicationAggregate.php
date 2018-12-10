<?php

declare(strict_types=1);

namespace LoanApplication;

use http\Exception\RuntimeException;
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

    public function submitApplication()
    {
        if ($this->loanApplication->getStatus() != 'draft') {
            throw new RuntimeException("application is not in draft state");
        }

        $this->loanApplication->setState('Submitted');

        $this->publish( new LoanApplicationSubmitted($this->loanApplication->getId()));

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

    public function publish(EventInterface $event) {
        $this->pendingEvents[] = $event;
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