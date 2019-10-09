<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\InsufficientFundsException;
use InvalidArgumentException;

class Account
{
    /** @var Ledger */
    private $ledger;

    public function __construct()
    {
        $this->ledger = new Ledger();
    }

    public function deposit(float $amount): void
    {
        $this->ledger->addTransaction(new Deposit($amount));
    }

    public function withdraw(float $amount): float
    {
        if ($this->getBalance() < $amount) {
            throw new InsufficientFundsException();
        }

        $this->ledger->addTransaction(new Withdrawal($amount));

        return $amount;
    }

    public function getBalance(): float
    {
        return $this->ledger->getBalance();
    }
}
