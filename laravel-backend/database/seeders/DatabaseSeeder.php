<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Create dummy adming entry
        User::create([
            'name' => 'admin',
            'email' => 'admin@bank.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            ClientSeeder::class,
            ExchangeRateSeeder::class,
            CurrencyAccountSeeder::class,
        ]);
    }
}
