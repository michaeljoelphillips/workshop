<html>
    <body>
        <div>
            Current Balance: {{ $account->getBalance() }}
        </div>

        <div>
            {{ session('status') }}
        </div>

        <div>
            <form method='POST' action="/accounts/transact">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="deposit" />

                @error('amount')
                    <div>{{ $message }}</div>
                @enderror

                <input type="text" name="amount"></input>
                <input type="submit" value="Deposit"></input>
            </form>

            <form method='POST' action="/accounts/transact">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="withdraw" />

                @error('amount')
                    <div>{{ $message }}</div>
                @enderror

                <input type="text" name="amount" />
                <input type="submit" value="Withdraw" />
            </form>
        </div>

        <div>
            <table>
                <thead>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Transaction Date</th>
                </thead>

                <tbody>
                    @foreach ($account->getTransactions() as $transaction)
                        <tr>
                            <td>{{ get_class($transaction) }}</td>
                            <td>{{ $transaction->getAmount() }}</td>
                            <td>{{ $transaction->getTransactionDate()->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
