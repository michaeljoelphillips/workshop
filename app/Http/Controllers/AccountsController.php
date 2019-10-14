<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Account;
use App\Exceptions\InsufficientFundsException;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\View\View;
use InvalidArgumentException;

class AccountsController
{
    private $accounts;
    private $session;

    public function __construct(AccountRepositoryInterface $accounts, Store $session)
    {
        $this->accounts = $accounts;
        $this->session = $session;
    }

    public function index(Request $request): View
    {
        $account = $this->getAccount();

        return view('accounts', [
            'account' => $account,
        ]);
    }

    public function transact(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:deposit,withdraw',
        ]);

        $amount = (float) $request->get('amount');
        $account = $this->getAccount();

        try {
            if ('deposit' === $request->get('type')) {
                $account->deposit($amount);
            } else {
                $account->withdraw($amount);
            }

            $this->accounts->save($account);

            return back()->with('status', 'Transaction processed successfully');
        } catch (InsufficientFundsException $e) {
            return back()->with('status', 'You do not have sufficient funds available to process this transaction.');
        } catch (InvalidArgumentException $e) {
            return back()->with('status', $e->getMessage());
        }
    }

    private function getAccount(): Account
    {
        $accountId = $this->session->get('account');

        return $this->accounts->find($accountId);
    }
}
