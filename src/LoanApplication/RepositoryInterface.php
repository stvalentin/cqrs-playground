<?php
declare(strict_types=1);

namespace LoanApplication;

interface RepositoryInterface
{
    public function getById(string $id): LoanApplicationAggregate;
    public function save(AggregateInterface $aggregate);
    public function count(): Int;
}