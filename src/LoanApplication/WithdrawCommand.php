<?php
/**
 * Created by PhpStorm.
 * User: stanciuvalentin
 * Date: 08/12/2018
 * Time: 09:33
 */

namespace LoanApplication;


class WithdrawCommand
{
    /**
     * @var int
     */
    private $applicationId;

    /**
     * WithdrawCommand constructor.
     * @param int $applicationId
     */
    public function __construct(int $applicationId)
    {

        $this->applicationId = $applicationId;
    }

    public function getId(): int {
        return $this->applicationId;
    }
}