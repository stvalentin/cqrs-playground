<?php
/**
 * Created by PhpStorm.
 * User: stanciuvalentin
 * Date: 09/12/2018
 * Time: 15:00
 */

namespace Tests\Mocks;


use LoanApplication\LoanApplicationState;
use Ramsey\Uuid\Uuid;

class LoanApplicationStateMock
{
    public const ID = 'e484a33a-4a41-4dca-8c7a-377e4e4d63d4';
    public const STATUS = 'DRAFT';
    public const FIRST_NAME = 'JOHN';
    public const LAST_NAME = 'JOHN';
    public const EMAIL = 'stanciu@gmnail.com';

    public static function create(array $values = []): LoanApplicationState
    {
        $values += [
            'id' => self::ID,
            'status' => self::STATUS,
            'first_name' => self::FIRST_NAME,
            'last_name' => self::LAST_NAME,
            'email' => self::EMAIL
        ];

        return new LoanApplicationState(self::ID, $values['status'], self::FIRST_NAME, self::LAST_NAME, self::EMAIL);
    }
}