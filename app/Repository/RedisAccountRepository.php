<?php

declare(strict_types=1);

namespace App\Repository;

use App\Account;
use Psr\SimpleCache\CacheInterface;

class RedisAccountRepository implements AccountRepositoryInterface
{
    private const KEY_PREFIX = 'accounts';

    private $redis;

    public function __construct(CacheInterface $redis)
    {
        $this->redis = $redis;
    }

    public function find(string $id): ?Account
    {
        return $this->redis->get(sprintf('%s-%s', self::KEY_PREFIX, $id));
    }

    public function findAll(): iterable
    {
        return $this->redis->get(sprintf('%s-*', self::KEY_PREFIX));
    }

    public function save(Account $account)
    {
        $this->redis->set(sprintf('%s-%s', self::KEY_PREFIX, $account->getId()), $account);
    }
}
