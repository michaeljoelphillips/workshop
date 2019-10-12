<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;

use App\Account;
use App\Repository\RedisAccountRepository;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

class RedisAccountRepositoryTest extends TestCase
{
    public function testFind(): void
    {
        $redis = $this->createMock(CacheInterface::class);
        $subject = new RedisAccountRepository($redis);

        $account = new Account();

        $redis
            ->expects(self::once())
            ->method('get')
            ->with(sprintf('accounts-%s', $account->getId()))
            ->willReturn($account);

        self::assertSame($account, $subject->find($account->getId()));
    }

    public function testSave(): void
    {
        $redis = $this->createMock(CacheInterface::class);
        $subject = new RedisAccountRepository($redis);

        $account = new Account();

        $redis
            ->expects($this->once())
            ->method('set')
            ->with(sprintf('accounts-%s', $account->getId()), $account);

        $subject->save($account);
    }
}
