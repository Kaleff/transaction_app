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
        Schema::create('currency_accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('currency', array('EUR', 'GBP', 'USD', 'CHF', 'HUF', 'UAH', 'CZK', 'SEK', 'DKK', 'NOK', 'GEL', 'RON', 'PLN', 'AZN', 'TRY', 'BGN', 'MXN', 'CAD', 'AUD', 'CNY', 'JPY'));
            $table->foreignId('client_id');
            $table->double('amount', 12, 2);
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_accounts');
    }
};
