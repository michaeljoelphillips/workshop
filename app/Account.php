<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\InsufficientFundsException;
use Ramsey\Uuid\Uuid;

class Account
{
    private $id;
    protected $ledger;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->ledger = new Ledger();
    }

    public function getId(): string
    {
        return (string) $this->id;
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

    public function getTransactions(): array
    {
        return $this->ledger->getTransactions();
    }
}
