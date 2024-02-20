<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Create dummy admin entry.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@bank.com',
            'password' => Hash::make('password'),
        ]);
    }
}
