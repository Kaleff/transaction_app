<?php

namespace App\Http\Controllers;

use App\Models\CurrencyAccount;
use Illuminate\Http\Request;

class CurrencyAccountController extends Controller
{
    /**
     * Route GET api/accounts/{$id} 
     */ 
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
            ], 404);
        }
        $date = array_column($transactions, 'created_at');
        array_multisort($transactions, SORT_DESC, $date);
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }
    /**
     * Route GET api/accounts/{$senderAccId}/{$recipientAccId}
     */
    public function retrieve(int $senderAccId, int $recipientAccId) {
        if($recipientAccId == $senderAccId) {
            return response()->json([
                'success' => false,
                'errors' => ["Can't transfer funds to the same account"]
            ], 406);
        }
        $sender = CurrencyAccount::find($senderAccId);
        $recipient = CurrencyAccount::find($recipientAccId);
        if(!$sender || !$recipient) {
            $notfound = !$sender && !$recipient ? 'Recipient and sender were not found' : ($sender ? 'Recipient account was not found' : 'Sender was not found');
            return response()->json([
                'success' => false,
                'errors' => [$notfound]
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'sender' => $sender,
                'recipient' => $recipient 
            ]
        ]);
    }
}
