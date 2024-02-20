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
        // Foreign Keys
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('sender_id')->references('id')->on('clients');
            $table->foreign('recipient_id')->references('id')->on('clients');
            $table->foreign('sender_account_id')->references('id')->on('currency_accounts');
            $table->foreign('recipient_account_id')->references('id')->on('currency_accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys
        Schema::table('transactions', function (Blueprint $table) {
            // Sender Id
            $table->dropForeign('transactions_sender_id_foreign');
            $table->dropIndex('transactions_sender_id_index');
            $table->dropColumn('sender_id');
            // Recipient Id
            $table->dropForeign('transactions_recipient_id_foreign');
            $table->dropIndex('transactions_recipient_id_index');
            $table->dropColumn('recipient_id');
            // Sender account Id
            $table->dropForeign('transactions_sender_account_id_foreign');
            $table->dropIndex('transactions_sender_account_id_index');
            $table->dropColumn('sender_account_id');
            // Recipient account Id
            $table->dropForeign('transactions_recipient_account_id_foreign');
            $table->dropIndex('transactions_recipient_account_id_index');
            $table->dropColumn('recipient_account_id');
        });
        Schema::dropIfExists('transactions');
    }
};
