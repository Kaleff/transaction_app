<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show($clientId) {
        $client = Client::find($clientId);
        // Return 404 if client is not found
        if(!$client) {
            return response()->json([
                'errors' => ["User under the id $clientId was not found"],
                'success' => false
            ], 404);
        }
        $accounts = $client->currencyAccounts;
        // Return 404 if client does not have any currency accounts
        if(!count($accounts)) {
            return response()->json([
                'errors' => ['User does not have any currency accounts'],
                'success' => false
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $accounts
        ]);
    }
}
