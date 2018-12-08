<?php

declare(strict_types=1);

namespace LoanApplication;

class LoanApplicationAggregate implements AggregateInterface
{

    /**
     * @var LoanApplication
     */
    private $loanApplication;

    /**
     * LoanApplicationAggregate constructor.
     * @param LoanApplication $loanApplication
     */
    public function __construct(LoanApplication $loanApplication)
    {

        $this->loanApplication = $loanApplication;
    }

    public function withdraw(): void
    {

    }


    public function acceptOffer(Int $offerId): void
    {

    }

    public function getState(): AggregateInterface
    {
        return $this->loanApplication;
    }
}