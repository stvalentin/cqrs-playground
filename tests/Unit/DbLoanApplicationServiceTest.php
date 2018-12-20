<?php
declare(strict_types=1);
namespace Tests\Unit;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Mapping\Entity;
use LoanApplication\Command\StartApplicationCommand;
use LoanApplication\Command\SubmitApplicationCommand;
use LoanApplication\DbRepository;
use LoanApplication\InMemoryRepository;
use LoanApplication\LoanApplicationService;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Mocks\LoanApplicationStateMock;

class DbLoanApplicationServiceTest extends LoanApplicationServiceTest
{

    public function setUp()
    {
        $connection = DriverManager::getConnection([
            'host' => getenv('db_host'),
            'dbname' => getenv('db_name'),
            'user' => getenv('db_user'),
            'password' => getenv('db_password'),
            'driver' => 'pdo_pgsql',
        ]);

        $this->repository = new DbRepository($connection);
    }
}