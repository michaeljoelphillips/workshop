<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

class Deposit implements TransactionInterface
{
    private $amount;

    public function __construct(float $amount)
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException(sprintf('Deposit amount must be greater than zero.'));
        }

        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
