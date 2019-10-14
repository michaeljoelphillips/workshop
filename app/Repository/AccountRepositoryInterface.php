<?php

declare(strict_types=1);

namespace App\Repository;

use App\Account;

interface AccountRepositoryInterface
{
    public function find(string $id): ?Account;
    public function findAll(): iterable;
    public function save(Account $account);
}
