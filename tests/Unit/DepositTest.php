<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Deposit;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DepositTest extends TestCase
{
    public function testGetAmount(): void
    {
        $subject = new Deposit(100.0);

        self::assertEquals(100.0, $subject->getAmount());
    }

    public function testDepositWithNegativeAmounts(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Deposit amount must be greater than zero.');

        new Deposit(-10.0);
    }
}
