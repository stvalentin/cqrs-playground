<?php
/**
 * Created by PhpStorm.
 * User: stanciuvalentin
 * Date: 08/12/2018
 * Time: 13:00
 */

namespace LoanApplication;


class CustomerAggregate implements AggregateInterface
{
    private $state;

    public function __construct(CustomerApplication $state)
    {
        $this->state = $state;
    }

    public function getState(): AggregateInterface
    {
        return $this->state;
    }
}