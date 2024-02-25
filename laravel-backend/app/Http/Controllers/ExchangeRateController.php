<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    /**
     * Route api/rates
     */
    public function store(Request $request)
    {
        // Check if base currency is Euro and request was successful
        /*if($request->base != "EUR" || !$request->success) {
            return [];
        } */
        $query = [];
        foreach(config('currency.api_sample') as $currency => $rate) {
            $query[] = [
                'currency' => $currency,
                'exchange_rate' => $rate
            ];
        }
        ExchangeRate::upsert($query, [
            ['currency', 'name'], ['exchange_rate']
        ]);
        return response()->json($query);
    }
}
