<?php

declare(strict_types=1);

namespace App;

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
}
