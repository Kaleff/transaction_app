<?php

namespace App\Http\Controllers;

use App\Models\CurrencyAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Helper function to ceil up to the second decimal place
     */
    private function round_up(float $value, int $precision): float
    {
        $pow = pow(10, $precision);
        return (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
    }

    /**
     * Route api/transaction
     */
    public function store(Request $request)
    {
        // Validate sender/recipient data
        $accountValidator = Validator::make($request->all(), [
            'sender_account_id' => 'required|numeric',
            'recipient_account_id' => 'required|numeric',
        ], config('validator.transaction.messages'));
        if($accountValidator->fails()) {
            return response()->json([
                'errors' => $accountValidator->errors()->all(),
                'success' => false
            ], 406);
        }
        $sender = CurrencyAccount::find($request->sender_account_id);
        $recipient = CurrencyAccount::find($request->recipient_account_id);
        // Return 404 if accounts are not found
        if(!$sender || !$recipient) {
            $notfound = !$sender && !$recipient ? 'Recipient and sender were not found' : ($sender ? 'Recipient account was not found' : 'Sender was not found');
            return response()->json([
                'errors' => [$notfound],
                'success' => false
            ], 404);
        }
        // Validate general request data
        $deductable = $this->round_up($request->amount * $sender->exchangeRate['exchange_rate'] / $recipient->exchangeRate['exchange_rate'], 2);
        $validator = Validator::make($request->all(), [
            // Validate if Recipient and transaction currency is the same
            'currency' => 'required|in:' . $recipient->currency,
            'amount' => 'required|gte:1'
        ], config('validator.transaction.messages'));
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
                'success' => false
            ], 406);
        }
        // Return error if sender has insufficient funds for the transaction
        if ($sender['amount'] < $deductable) {
            return response()->json([
                'errors' => ['Sender account has insufficient funds'],
                'success' => false
            ], 406);
        }
        // Form the transaction and perform the operation
        $transaction = [
            ...$accountValidator->validated(),
            'sender_id' => $sender->client_id,
            'recipient_id' => $recipient->client_id,
            'sender_amount' => $deductable,
            ...$validator->validated()
        ];
        // Deduct amount from sender and add to recipient
        $sender->amount -= $deductable;
        $sender->save();
        $recipient->amount += $request->amount;
        $recipient->save();
        Transaction::create($transaction);
        return response()->json([
            'success' => true,
            'message' => "$deductable $sender->currency was exchanged to $request->amount $recipient->currency and were sent to the recipient"
        ]);
    }
}
