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
        if($request->base != "EUR" || !$request->success || count($request->rates) == 0) {
            return response()->json([
                'success' => false,
                'errors' => ['Invalid request'],
            ], 406);
        }
        foreach($request->rates as $currency => $rate) {
            ExchangeRate::where('currency', $currency)->update(['exchange_rate' => $rate]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Exchange rates where updated successfully'
        ]);
    }
}
