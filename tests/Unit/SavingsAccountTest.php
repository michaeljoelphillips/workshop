<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\WithdrawalLimitMetException;
use App\SavingsAccount;
use PHPUnit\Framework\TestCase;

class SavingsAccountTest extends TestCase
{
    public function testWithdrawWhenWithdrawLimitHasExceededMonthlyAmount(): void
    {
        $subject = new SavingsAccount();

        self::expectException(WithdrawalLimitMetException::class);

        $subject->deposit(100.0);
        $subject->withdraw(10.0);
        $subject->withdraw(10.0);
        $subject->withdraw(10.0);
        $subject->withdraw(10.0);
        $subject->withdraw(10.0);
        $subject->withdraw(10.0);
        $subject->withdraw(10.0);
    }
}
