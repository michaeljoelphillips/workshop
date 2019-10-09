<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Deposit;
use App\Ledger;
use PHPUnit\Framework\TestCase;

class LedgerTest extends TestCase
{
    public function testAddTransaction(): void
    {
        $subject = new Ledger();
        $deposit = new Deposit(10.0);

        $subject->addTransaction($deposit);

        $this->assertEquals(10.0, $subject->getBalance());
    }

    public function testGetBalanceWithNoTransactionsRecorded(): void
    {
        $subject = new Ledger();

        $this->assertEquals(0.0, $subject->getBalance());
    }
}
