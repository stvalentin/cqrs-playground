<?php
/**
 * Created by PhpStorm.
 * User: stanciuvalentin
 * Date: 08/12/2018
 * Time: 15:47
 */

namespace LoanApplication;


class LoanApplicationSubmitted implements EventInterface
{

    /**
     * LoanApplicationSubmited constructor.
     * @param UuidInterface $id
     */
    public function __construct(string $id)
    {
    }
}