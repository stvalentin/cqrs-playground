<?php
/**
 * Created by PhpStorm.
 * User: stanciuvalentin
 * Date: 09/12/2018
 * Time: 18:32
 */

namespace LoanApplication\Command;


class SubmitApplicationCommand
{
    private $id;

    public function __construct(array $payload)
    {
        $this->id = $payload['id'];
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }
}