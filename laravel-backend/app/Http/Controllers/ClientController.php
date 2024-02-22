<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show($clientId) {
        $accounts = Client::find($clientId)->currencyAccounts;
        return $accounts;
    }
}
