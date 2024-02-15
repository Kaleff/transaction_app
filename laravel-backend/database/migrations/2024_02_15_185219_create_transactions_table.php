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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('currency', array('EUR', 'GBP', 'USD', 'CHF', 'HUF', 'UAH', 'CZK', 'SEK', 'DKK', 'NOK', 'GEL', 'RON', 'PLN', 'AZN', 'TRY', 'BGN', 'MXN', 'CAD', 'AUD', 'CNY', 'JPY'));
            $table->enum('sent_currency', array('EUR', 'GBP', 'USD', 'CHF', 'HUF', 'UAH', 'CZK', 'SEK', 'DKK', 'NOK', 'GEL', 'RON', 'PLN', 'AZN', 'TRY', 'BGN', 'MXN', 'CAD', 'AUD', 'CNY', 'JPY'));
            $table->enum('received_currency', array('EUR', 'GBP', 'USD', 'CHF', 'HUF', 'UAH', 'CZK', 'SEK', 'DKK', 'NOK', 'GEL', 'RON', 'PLN', 'AZN', 'TRY', 'BGN', 'MXN', 'CAD', 'AUD', 'CNY', 'JPY'));
            $table->double('amount', 12, 2);
            $table->double('host_currency_amount', 12, 2);
            $table->double('exchange_rate', 12, 6);
            $table->foreignId('sender_id');
            $table->foreignId('recipient_id');
            $table->foreignId('sender_account_id');
            $table->foreignId('recipient_account_id');
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
