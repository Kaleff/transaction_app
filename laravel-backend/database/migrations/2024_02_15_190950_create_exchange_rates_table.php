<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('currency', array('EUR', 'GBP', 'USD', 'CHF', 'HUF', 'UAH', 'CZK', 'SEK', 'DKK', 'NOK', 'GEL', 'RON', 'PLN', 'AZN', 'TRY', 'BGN', 'MXN', 'CAD', 'AUD', 'CNY', 'JPY'));
            $table->string('name');
            $table->double('exchange_rate', 12, 6);
            $table->double('reverse_exchange_rate', 12, 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
