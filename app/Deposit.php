<?php

declare(strict_types=1);

namespace App;

use DateTimeImmutable;
use InvalidArgumentException;

class Deposit implements TransactionInterface
{
    private $amount;
    private $transactionDate;

    public function __construct(float $amount)
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException(sprintf('Deposit amount must be greater than zero.'));
        }

        $this->amount = $amount;
        $this->transactionDate = new DateTimeImmutable();
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTransactionDate(): DateTimeImmutable
    {
        return $this->transactionDate;
    }
}
