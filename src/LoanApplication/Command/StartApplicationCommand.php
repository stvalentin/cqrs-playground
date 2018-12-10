<?php
declare(strict_types=1);

namespace LoanApplication\Command;

use LoanApplication\StartLoanApplication;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class StartApplicationCommand
{
    /**
     * @var UuidInterface
     */
    private $uuid;
    private $firstName;
    private $email;
    private $lastName;
    /**
     * @var array
     */
    private $payload;

    /**
     * StartApplicationCommand constructor.
     * @param StartLoanApplication $request
     * @param UuidInterface $uuid
     */
    public function __construct(array $payload)
    {
        $this->uuid = $payload['id'];
        $this->firstName = $payload['firstName'];
        $this->lastName = $payload['lastName'];
        $this->email = $payload['email'];
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->uuid);
    }
}