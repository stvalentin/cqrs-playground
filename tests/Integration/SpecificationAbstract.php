<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;

abstract class SpecificationAbstract extends TestCase
{
    abstract protected function given();
    abstract protected function when();
    abstract protected function then();
}