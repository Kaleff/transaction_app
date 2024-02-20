<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Populate the currency table with base currency info if not done before, and update rates based on 3-rd party resource
     */
    public function run(): void
    {
        ExchangeRate::upsert(config('currency.rates'), [
            ['currency', 'name'], ['exchange_rate']
        ]);
    }
}
