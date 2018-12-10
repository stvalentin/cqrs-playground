<?php
declare(strict_types=1);

namespace LoanApplication;

use LoanApplication\Command\StartApplicationCommand;
use LoanApplication\Command\SubmitApplicationCommand;
use Ramsey\Uuid\Uuid;

/**
 * @ASK this can also be moved to an StartApplicationCommandHandler
 *
 * Class LoanApplicationService
 * @package LoanApplication
 */
class LoanApplicationService
{

    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(
        RepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function whenStart(StartApplicationCommand $command)
    {
        $aggregate = LoanApplicationAggregate::startApplication($command->getId(), $command->getEmail(), $command->getFirstName(), $command->getLastName());
        $this->repository->save($aggregate);
    }

    public function whenSubmit(SubmitApplicationCommand $command)
    {
        $aggregate = $this->repository->getById($command->getId());
        $aggregate->submitApplication();
        $this->repository->save($aggregate);
    }

    /**
     * @param WithdrawCommand $command
     * @return array|null
     */
    public function whenWithdraw(WithdrawCommand $command): ?array
    {
        $aggregate = $this->repository->getById($command->getId());
        $aggregate->widhdraw();

        $brokenRules = $aggregate->getBrokenRules();

        if (count($brokenRules) > 0) {
            return $brokenRules;
        }

        $this->repository->save($aggregate);
    }

    public function whenAcceptOffer(AcceptOfferCommand $command): ?array
    {
        $aggregate = $this->repository->getById($command->getId());
        $aggregate->acceptOffer($command->offerId());

        $brokenRules = $aggregate->getBrokenRules();

        if (count($brokenRules) > 0) {
            return $brokenRules;
        }

        $this->repository->save($aggregate);
    }
}