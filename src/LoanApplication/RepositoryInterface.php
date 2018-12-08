<?php
declare(strict_types=1);

namespace LoanApplication;

interface RepositoryInterface
{
    public function getById(Int $id): LoanApplicationAggregate;
    public function save(AggregateInterface $aggregate);
}