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
            $table->enum('currency', config('currency.all_currencies'));
            $table->foreignId('client_id');
            $table->double('amount', 12, 2);
            $table->softDeletesTz();
        });

        Schema::table('currency_accounts', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients'); //->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys
        Schema::table('currency_accounts', function (Blueprint $table) {
            $table->dropForeign('currency_accounts_client_id_foreign');
            $table->dropIndex('currency_accounts_client_id_index');
            $table->dropColumn('client_id');
        });
        Schema::dropIfExists('currency_accounts');
    }
};
