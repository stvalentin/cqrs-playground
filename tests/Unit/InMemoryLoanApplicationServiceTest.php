<?php
declare(strict_types=1);
namespace Tests\Unit;

use LoanApplication\Command\StartApplicationCommand;
use LoanApplication\Command\SubmitApplicationCommand;
use LoanApplication\InMemoryRepository;
use LoanApplication\LoanApplicationService;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Mocks\LoanApplicationStateMock;

class InMemoryLoanApplicationServiceTest extends LoanApplicationServiceTest
{
    public function setUp()
    {
        $this->repository = new InMemoryRepository();
    }
}