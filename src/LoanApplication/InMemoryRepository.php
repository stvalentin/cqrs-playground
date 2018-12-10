<?php
declare(strict_types=1);

namespace LoanApplication;

class InMemoryRepository implements RepositoryInterface
{
    /**
     * @var array
     */
    private $unitOfWork = [];

    public function getById(string $id): LoanApplicationAggregate
    {
        return new LoanApplicationAggregate($this->unitOfWork[$id]);
    }

    public function save(AggregateInterface $aggregate)
    {
        $state = $aggregate->getState();
        $this->unitOfWork[$state->getId()] = $state;
    }

    public function count(): int
    {
        return count($this->unitOfWork);
    }
}