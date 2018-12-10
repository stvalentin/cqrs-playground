<?php
declare(strict_types=1);

namespace LoanApplication;

use Ramsey\Uuid\UuidInterface;

class LoanApplicationState
{
    /**
     * @var string
     */
    private $status;
    /**
     * @var UuidInterface
     */
    private $id;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $email;

    /**
     * LoanApplication constructor.
     * @param UuidInterface $id
     * @param string $status
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     */
    public function __construct(
        UuidInterface $id,
        string $status,
        string $firstName,
        string $lastName,
        string $email

    ) {
        $this->status = $status;
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    static public function start(UuidInterface $uuid)
    {
        return new self($uuid, NULL, NULL, NULL, NULL);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function setState(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): string
    {
        return $this->id->toString();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}