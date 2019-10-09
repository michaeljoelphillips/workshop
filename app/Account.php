<?php

declare(strict_types=1);

namespace App;

class Account
{
    private $balance = 0.0;

    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }

    public function withdraw(float $amount): float
    {
        $this->balance -= $amount;

        return $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
