<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Account;
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
}
