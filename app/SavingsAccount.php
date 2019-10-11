<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\WithdrawalLimitMetException;
use DateInterval;
use DateTimeImmutable;

class SavingsAccount extends Account
{
    private const WITHDRAWAL_LIMIT = 6;
    private const ONE_MONTH_INTERVAL = 'P1M';
    private const FIRST_DAY_OF_MONTH = 'first day of this month';

    public function withdraw(float $amount): float
    {
        $withdrawals = $this->getWithdrawalsThisMonth();

        if (self::WITHDRAWAL_LIMIT === count($withdrawals)) {
            throw new WithdrawalLimitMetException();
        }

        return parent::withdraw($amount);
    }

    private function getWithdrawalsThisMonth(): array
    {
        $firstDayOfMonth = new DateTimeImmutable(self::FIRST_DAY_OF_MONTH);
        $oneMonth = new DateInterval(self::ONE_MONTH_INTERVAL);

        $transactions = $this->ledger->findByDateRange($firstDayOfMonth, $oneMonth);

        return array_filter(
            $transactions,
            function (TransactionInterface $transaction) {
                return $transaction instanceof Withdrawal;
            },
        );
    }
}
