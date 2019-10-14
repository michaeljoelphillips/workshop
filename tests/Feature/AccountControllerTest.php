<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Account;
use App\Http\Controllers\AccountsController;
use App\Repository\AccountRepositoryInterface;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    public function testIndexPage(): void
    {
        $this
            ->get('/accounts')
            ->assertSuccessful()
            ->assertSee('Current Balance: 0');
    }

    public function testDeposit(): void
    {
        $this
            ->post('/accounts/transact', [
                'type' => 'deposit',
                'amount' => '100.00',
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Transaction processed successfully');
    }

    public function testDepositWithMissingAmount(): void
    {
        $this
            ->post('/accounts/transact', [
                'type' => 'deposit',
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    public function testWithdrawWithInsufficientFunds(): void
    {
        $this
            ->post('/accounts/transact', [
                'type' => 'withdraw',
                'amount' => '100.00',
            ])
            ->assertStatus(302)
            ->assertSessionHas('status', 'You do not have sufficient funds available to process this transaction.');
    }

    public function testIndexPageWithExistingAccount(): void
    {
        $account = new Account();
        $account->deposit(100);
        $account->deposit(200);
        $account->withdraw(50);

        $repository = $this->createMock(AccountRepositoryInterface::class);

        $repository
            ->method('find')
            ->willReturn($account);

        $this
            ->app
            ->when(AccountsController::class)
            ->needs(AccountRepositoryInterface::class)
            ->give(function () use ($repository) {
                return $repository;
            });

        $this
            ->get('/accounts')
            ->assertSuccessful()
            ->assertSee(100)
            ->assertSee(200)
            ->assertSee(50);
    }
}
