<?php

declare(strict_types=1);

namespace Tests\Integration;


use LoanApplication\LoanApplicationAggregate;
use LoanApplication\LoanApplicationState;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\Mocks\LoanApplicationStateMock;

class LoanApplicationAggregateTest extends SpecificationAbstract
{

    private $sut;
    private $state;

    protected function given()
    {
        /*
         * state = new LoanApplicationState();
		sut = new LoanApplicationAggregate(state);
		id = Guid.NewGuid();
		email = "jdoe@foo.com"
		first = "John";
		last = "Doe";
        */
    }

    protected function when()
    {
        // TODO: Implement when() method.
    }

    protected function then()
    {
        // TODO: Implement then() method.
    }

    /**
     * @test
     * @throws \Exception
     */
    public function when_starting_a_new_application_loan()
    {
        //given
        $this->state = new LoanApplicationState($id = Uuid::uuid4(), $status = 'draft', $firstName = 'John', $lastName = 'Doe', $email = 'stanciu@gmail.com');

        //when
        $this->sut = LoanApplicationAggregate::startApplication($id, $email, $firstName, $lastName);

        //then
        $this->assertSame($this->sut->getState()->getStatus(), 'draft');
        $this->assertSame($this->sut->getState()->getId(), $id->toString());
        $this->assertSame($this->sut->getState()->getFirstName(), $firstName);
        $this->assertSame($this->sut->getState()->getLastName(), $lastName);
    }

    /**
     * @test
     * @throws \RuntimeException
     */
    public function when_submitting_an_already_submitted_application()
    {
        //given
        $this->state = LoanApplicationStateMock::create([
            'status' => 'Submitted'
        ]);

        //when
        $this->sut = new LoanApplicationAggregate($this->state);

        //then
        $this->expectException('\RuntimeException');
        $this->sut->submitApplication();
    }
}