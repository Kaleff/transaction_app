<?php

namespace App\Http\Controllers;

use App\Models\CurrencyAccount;
use Illuminate\Http\Request;

class CurrencyAccountController extends Controller
{
    // Route api/accounts/{$id}
    public function show($accountId) {
        $account = CurrencyAccount::find($accountId);
        // Return 404 if account is not found
        if(!$account) {
            return response()->json([
                'success' => false,
                'errors' => ['Account was not found']
            ], 404);
        }
        $transactions = $account->transactions;
        // Return 404 if no transactions are found
        if(!count($transactions)) {
            return response()->json([
                'success' => false,
                'errors' => ['Account has no transaction history']
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }
}
