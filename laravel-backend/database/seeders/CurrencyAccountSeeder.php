<?php

namespace Database\Seeders;

use App\Models\CurrencyAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurrencyAccount::factory(40)->create();
    }
}
