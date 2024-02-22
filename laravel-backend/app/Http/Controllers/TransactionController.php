<?php

namespace App\Http\Controllers;

use App\Models\CurrencyAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Helper function to ceil up to the second decimal place
     */
    private function round_up(float $value, int $precision) {
        $pow = pow ( 10, $precision ); 
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
    }

    // Route api/transaction
    public function store(Request $request) {
        $sender = CurrencyAccount::find($request->sender_account_id);
        $recipient = CurrencyAccount::find($request->recipient_account_id);
        
        $deductable = $this->round_up(
            $request->amount * $sender->exchangeRate['exchange_rate'] / $recipient->exchangeRate['exchange_rate'], 2
        );
        $validatedTransaction = $request->validate([
            'sender_account_id' => 'required',
            'recipient_account_id' => 'required',
            // Validate if Recipient and transaction currency is the same
            'currency' => 'required|in:' . $recipient->currency, 
            'amount' => 'required|min:1'
        ]);
        $transaction = [
            'sender_id' => $sender->client_id,
            'recipient_id' => $recipient->client_id,
            'sender_amount' => $deductable,
            ...$validatedTransaction
        ];
        // Return error if the transaction deduction is greater than sender's currency amount
        /*if($sender['amount'] < $deductable) {
            // Return Error
        } */
        // Deduct amount from sender and add to recipient
        $sender->amount -= $deductable;
        $sender->save();
        $recipient->amount += $request->amount;
        $recipient->save();
        Transaction::create($transaction);
        return [$deductable . $sender->currency . ' = ' . $request->amount . $recipient->currency];
    }
}
