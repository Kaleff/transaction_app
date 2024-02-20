<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CurrencyAccount>
 */
class CurrencyAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency' => Arr::random(config('currency.all_currencies')),
            'client_id' => rand(1, 10),
            'amount' => rand(1000, 15000),
        ];
    }
}
