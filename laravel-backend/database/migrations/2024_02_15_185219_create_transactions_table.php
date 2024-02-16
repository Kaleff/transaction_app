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
            $table->enum('currency', config('currency.all_currencies'));
            $table->enum('sent_currency', config('currency.all_currencies'));
            $table->enum('received_currency', config('currency.all_currencies'));
            $table->double('amount', 12, 2);
            $table->double('host_currency_amount', 12, 2);
            $table->double('exchange_rate', 12, 5);
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
