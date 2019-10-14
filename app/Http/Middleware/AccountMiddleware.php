<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Account;
use App\Repository\AccountRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class AccountMiddleware
{
    private $session;
    private $accounts;

    public function __construct(Store $session, AccountRepositoryInterface $accounts)
    {
        $this->session = $session;
        $this->accounts = $accounts;
    }

    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (false === $this->session->has('account')) {
            $account = new Account();

            $this->accounts->save($account);
            $this->session->put('account', $account->getId());
        }

        return $next($request);
    }
}
