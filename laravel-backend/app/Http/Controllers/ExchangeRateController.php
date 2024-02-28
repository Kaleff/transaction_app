<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    /**
     * Route GET api/rates
     */
    public function index() {
        // Get all rates except base currency (EUR)
        $rates = ExchangeRate::where('currency', '!=', 'EUR')->get();
        // Return 404 if there are no rates
        if(!count($rates)) {
            return response()->json([
                'errors' => ['No rates were found, please try again later.'],
                'success' => false
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $rates
        ]);
    }
    /**
     * Route POST api/rates
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
        $rates = ExchangeRate::where('currency', '!=', 'EUR')->get();
        return response()->json([
            'success' => true,
            'message' => 'Exchange rates where updated successfully',
            'data' => $rates
        ]);
    }
}
