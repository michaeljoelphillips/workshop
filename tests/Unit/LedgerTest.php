<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Deposit;
use App\Ledger;
use App\TransactionInterface;
use DateInterval;
use DateTimeImmutable;
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

    public function testFindByDateRange(): void
    {
        $subject = new Ledger();

        $thisMonthsTransaction = $this->createMock(TransactionInterface::class);
        $lastMonthsTransaction = $this->createMock(TransactionInterface::class);

        $subject->addTransaction($thisMonthsTransaction);
        $subject->addTransaction($lastMonthsTransaction);

        $thisMonthsTransaction
            ->method('getTransactionDate')
            ->willReturn(new DateTimeImmutable('2019-10-01'));

        $lastMonthsTransaction
            ->method('getTransactionDate')
            ->willReturn(new DateTimeImmutable('2019-09-01'));

        $thisMonthsTransactions = $subject->findByDateRange(new DateTimeImmutable('2019-10-01'), new DateInterval('P1M'));
        $lastMonthsTransactions = $subject->findByDateRange(new DateTimeImmutable('2019-09-01'), new DateInterval('P1M'));

        self::assertCount(1, $thisMonthsTransactions);
        self::assertCount(1, $lastMonthsTransactions);
        self::assertContains($thisMonthsTransaction, $thisMonthsTransactions);
        self::assertContains($lastMonthsTransaction, $lastMonthsTransactions);
    }
}
