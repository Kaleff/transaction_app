<?php

namespace App\Http\Controllers;

use App\Models\CurrencyAccount;
use Illuminate\Http\Request;

class CurrencyAccountController extends Controller
{
    // Route api/accounts/{$id}
    public function show($accountId) {
        $userAccounts = CurrencyAccount::find($accountId);
        return $userAccounts;
    }
}
