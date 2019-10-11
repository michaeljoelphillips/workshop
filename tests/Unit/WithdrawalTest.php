<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Withdrawal;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WithdrawalTest extends TestCase
{
    public function testGetAmount(): void
    {
        $subject = new Withdrawal(100.0);

        self::assertEquals(-100.0, $subject->getAmount());
    }

    public function testWithdrawalWithNegativeAmounts(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Withdrawal amount must be greater than zero.');

        new Withdrawal(-10.0);
    }

    public function testGetTransactionDate(): void
    {
        $subject = new Withdrawal(10.0);

        $transactionDate = $subject->getTransactionDate();

        self::assertInstanceOf(DateTimeImmutable::class, $transactionDate);
        self::assertSame($transactionDate, $subject->getTransactionDate());
        self::assertEquals((new DateTimeImmutable())->format('Y-m-d'), $transactionDate->format('Y-m-d'));
    }
}
