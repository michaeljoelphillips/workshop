<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\AccountRepositoryInterface;
use App\Repository\RedisAccountRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Predis\Client;
use Predis\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\RedisCache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this
            ->app
            ->when(RedisAccountRepository::class)
            ->needs(CacheInterface::class)
            ->give(function (Application $app): CacheInterface {
                $predis = $app->make(ClientInterface::class);

                return new RedisCache($predis);
            });

        $this->app->bind(ClientInterface::class, function (Application $app): ClientInterface {
            return new Client([
                'schema' => 'tcp',
                'host' => config('database.redis.default.host'),
                'port' => config('database.redis.default.port'),
            ]);
        });

        $this->app->bind(AccountRepositoryInterface::class, RedisAccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
