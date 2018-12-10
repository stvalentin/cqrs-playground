<?php
declare(strict_types=1);

namespace LoanApplication;

use Ramsey\Uuid\Uuid;

class StartLoanApplication
{
    /**
     * @var Uuid
     */
    private $uuid;
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
     * StartLoanApplication constructor.
     * @param Uuid $id
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     */
    public function __construct(
        Uuid $id,
        string $firstName,
        string $lastName,
        string $email
    ) {
        $this->uuid = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}