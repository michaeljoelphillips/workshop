<?php

declare(strict_types=1);

namespace App;

use DateTimeImmutable;

interface TransactionInterface
{
    public function getAmount(): float;

    public function getTransactionDate(): DateTimeImmutable;
}
