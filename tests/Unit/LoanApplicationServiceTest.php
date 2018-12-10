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

class LoanApplicationServiceTest extends TestCase
{

    /**
     * @var \InMemoryRepository
     */
    private $repository;

    public function setUp()
    {
        $this->repository = new InMemoryRepository();
    }

    /**
     * @test
     */
    public function when_starting_a_new_application_loan()
    {
        //given
        
        $sut = new LoanApplicationService($this->repository);

        $commandStart = new StartApplicationCommand([
            'id' => LoanApplicationStateMock::ID,
            'email' => LoanApplicationStateMock::EMAIL,
            'firstName' => LoanApplicationStateMock::FIRST_NAME,
            'lastName' => LoanApplicationStateMock::LAST_NAME,
        ]);

        //when
        $sut->whenStart($commandStart);

        //Then
        $this->assertSame(1, $this->repository->count());
    }

    /**
     * @test
     */
    public function when_submitting_an_existing_loan()
    {
        //given
        $sut = new LoanApplicationService($this->repository);
        $commandStart = new StartApplicationCommand([
            'id' => LoanApplicationStateMock::ID,
            'email' => LoanApplicationStateMock::EMAIL,
            'firstName' => LoanApplicationStateMock::FIRST_NAME,
            'lastName' => LoanApplicationStateMock::LAST_NAME,
        ]);

        $commandSubmit = new SubmitApplicationCommand(['id' => LoanApplicationStateMock::ID]);
        $sut->whenStart($commandStart);

        //when
        $sut->whenSubmit($commandSubmit);

        //then
        $this->assertSame(1, $this->repository->count());
    }
}