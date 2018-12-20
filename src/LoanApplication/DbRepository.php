<?php

namespace LoanApplication;


use Doctrine\DBAL\Connection;
use http\Exception\RuntimeException;

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
        $events = $aggregate->getUncommittedEvents();
        if (count($events)) {
            return ;
        }

        $originalVersion = $aggregate->getVersion() - count($events) + 1;

        $this->connection->beginTransaction();

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('version');
        $queryBuilder->from('events');
        $queryBuilder->andWhere('id', $aggregate->getAggregateId());
        $queryBuilder->orderBy('version', 'desc');
        $queryBuilder->setMaxResults(1);

        $message = $queryBuilder->execute()->fetch();

        $version = 0;
        if (!$message) {
            $version = $message['version'];
        }

        if ($version  >= $originalVersion ) {
            throw new RuntimeException('concurrency exception');
        }

        foreach ($events as $event) {
            //
        }

        $this->connection->commit();
    }

    public function count(): Int
    {
        // TODO: Implement count() method.
    }
}