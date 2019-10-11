<?php

declare(strict_types=1);

namespace App;

use DateInterval;
use DateTimeImmutable;

class Ledger
{
    /** @var TransactionInterface[] */
    private $transactions = [];

    public function addTransaction(TransactionInterface $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function getBalance(): float
    {
        return array_reduce(
            $this->transactions,
            function (float $balance, TransactionInterface $transaction) {
                return $balance += $transaction->getAmount();
            },
            0.0
        );
    }

    public function findByDateRange(DateTimeImmutable $startDate, DateInterval $interval): array
    {
        $endDate = $startDate->add($interval);

        return array_filter(
            $this->transactions,
            function (TransactionInterface $transaction) use ($startDate, $endDate) {
                $transactionDate = $transaction->getTransactionDate();

                return $transactionDate >= $startDate && $transactionDate < $endDate;
            }
        );
    }
}
