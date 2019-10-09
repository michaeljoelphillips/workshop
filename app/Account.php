<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\InsufficientFundsException;
use InvalidArgumentException;

class Account
{
    private $balance = 0.0;

    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException(sprintf('Deposit amount must be greater than zero.'));
        }

        $this->balance += $amount;
    }

    public function withdraw(float $amount): float
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException(sprintf('Withdrawal amount must be greater than zero.'));
        }

        if ($this->getBalance() < $amount) {
            throw new InsufficientFundsException();
        }

        $this->balance -= $amount;

        return $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
