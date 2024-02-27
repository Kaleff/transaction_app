<?php

namespace App\Http\Controllers;

use App\Models\CurrencyAccount;
use Illuminate\Http\Request;

class CurrencyAccountController extends Controller
{
    // Route api/accounts/{$id}
    public function show(int $accountId) {
        $account = CurrencyAccount::find($accountId);
        // Return 404 if account is not found
        if(!$account) {
            return response()->json([
                'success' => false,
                'errors' => ['Account was not found']
            ], 404);
        }
        $transactions = [...$account->transactionsSent, ...$account->transactionsReceived];
        // Return 404 if no transactions are found
        if(!count($transactions)) {
            return response()->json([
                'success' => false,
                'errors' => ['Account has no transaction history']
            ]);
        }
        $date = array_column($transactions, 'created_at');
        array_multisort($transactions, SORT_DESC, $date);
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }
}
