<?php
declare(strict_types=1);

use LoanApplication\AggregateInterface;
use LoanApplication\LoanApplicationAggregate;
use LoanApplication\RepositoryInterface;

class InMemoryRepository implements RepositoryInterface
{


    /**
     * @var array
     */
    private $unitOfWork = [];

    public function getById(Int $id): LoanApplicationAggregate
    {
        return $this->unitOfWork[$id];
    }

    public function save(AggregateInterface $aggregate)
    {
        $state = $aggregate->getState();
        $this->unitOfWork[] = $state;
    }
}