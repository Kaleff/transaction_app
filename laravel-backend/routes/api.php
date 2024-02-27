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

Route::resources([
    // get api/accounts/{$id} -> show()
    'accounts' => CurrencyAccountController::class,
    // get api/client/{$id} -> show()
    'client'=>ClientController::class,
    // post api/transaction -> store()
    'transaction' => TransactionController::class,
    // post api/rates -> store()
    'rates' => ExchangeRateController::class
]);
