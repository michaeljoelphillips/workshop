<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\SavingsAccount;

class SavingsAccountTest extends TestCase
{
    public function testGetTransactionsThisMonth()
    {
        $subject = new SavingsAccount();
    }
}
