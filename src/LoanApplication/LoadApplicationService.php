<?php
declare(strict_types=1);

namespace LoanApplication;


class LoadApplicationService
{
    public function whenWithdraw(WithdrawCommand $command): void
    {
        $aggregate = $this->repository->getById($command->getId());
        $aggregate->widhdraw();
        $this->repository->save($aggregate);
    }

    public function whenAcceptOffcer(AcceptOfferCommand $command): void
    {
        $aggregate = $this->repository->getById($command->getId());
        $aggregate->acceptOffer($command->offerId);
        $this->repository->save($aggregate);
    }
}