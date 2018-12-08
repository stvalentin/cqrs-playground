<?php
declare(strict_types=1);

namespace LoanApplication;

class LoanApplicationController
{
    /**
     * @var LoadApplicationService
     */
    private $service;

    /**
     * LoanApplicationController constructor.
     * @param LoadApplicationService $service
     */
    public function __construct(LoadApplicationService $service)
    {
        $this->service = $service;
    }


    public function post_withdraw(int $applicationId)
    {
        $command = new WithdrawCommand($applicationId);
        $this->service->whenWithdraw($command);
    }

    public function post_acceptoffeer(Int $applicationId, Int $offerId)
    {
        $command = new AcceptOfferCommand($applicationId, $offerId);
        $this->service->whenAcceptOffcer($command);
    }
}