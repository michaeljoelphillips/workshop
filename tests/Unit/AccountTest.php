<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Account;
use App\Exceptions\InsufficientFundsException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testDeposit(): void
    {
        $subject = new Account();

        $subject->deposit(350.00);
        $subject->deposit(150.00);

        self::assertEquals(500.00, $subject->getBalance());
    }

    public function testWithdraw(): void
    {
        $subject = new Account();

        $subject->deposit(300.00);
        $withdrawnFunds = $subject->withdraw(100.00);

        self::assertEquals(200.00, $subject->getBalance());
        self::assertEquals(100.00, $withdrawnFunds);
    }

    public function testWithdrawWithInsufficientFunds(): void
    {
        $subject = new Account();

        self::expectException(InsufficientFundsException::class);

        $subject->withdraw(400.00);
    }

    public function testWithdrawWithZeroDollars(): void
    {
        $subject = new Account();

        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Withdrawal amount must be greater than zero.');

        $subject->withdraw(0.00);
    }

    public function testDepositWithZeroDollars(): void
    {
        $subject = new Account();

        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Deposit amount must be greater than zero.');

        $subject->deposit(0.00);
    }
}
