<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CurrencyAccountController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('sender.recipient.retrieve')
    ->get('/accounts/{senderAccId}/{recipientAccId}', [CurrencyAccountController::class, 'retrieve']);

Route::resources([
    // GET api/accounts/{$id} -> show($id)
    'accounts' => CurrencyAccountController::class,
    // GET api/client/{$id} -> show($id)
    'client'=>ClientController::class,
    // POST api/transaction -> store($request)
    'transaction' => TransactionController::class,
    /**
     * GET api/rates -> index();
     * POST api/rates -> store($request);
     */
    'rates' => ExchangeRateController::class
]);