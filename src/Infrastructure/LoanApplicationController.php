<?php
declare(strict_types=1);

namespace LoanApplication;

use http\Env\Request;
use Ramsey\Uuid\Uuid;

class LoanApplicationController
{
    /**
     * @var LoanApplicationService
     */
    private $service;

    /**
     * LoanApplicationController constructor.
     * @param LoanApplicationService $service
     */
    public function __construct(LoanApplicationService $service)
    {
        $this->service = $service;
    }

    public function put_start(StartLoanApplication $request)
    {
        $uuid = Uuid::uuid5();
        $command = new StartApplicationCommand($request, $uuid);
        $this->service->whenStartCommand($command);
        return new Request(200);
    }

    public function post_withdraw(int $applicationId)
    {
        $command = new WithdrawCommand($applicationId);
        $this->service->whenWithdraw($command);
    }

    public function post_acceptoffeer(Int $applicationId, Int $offerId)
    {
        $command = new AcceptOfferCommand($applicationId, $offerId);
        $this->service->whenAcceptOffer($command);
    }
}