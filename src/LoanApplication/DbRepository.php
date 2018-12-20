<?php

namespace LoanApplication;


use Doctrine\DBAL\Connection;

class DbRepository implements RepositoryInterface
{

    /**
     * @var Connection
     */
    private $connection;

    /**
     * DbRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {

        $this->connection = $connection;
    }

    public function getById(string $id): LoanApplicationAggregate
    {
        // TODO: Implement getById() method.
    }

    public function save(AggregateInterface $aggregate)
    {
        // TODO: Implement save() method.
    }

    public function count(): Int
    {
        // TODO: Implement count() method.
    }
}