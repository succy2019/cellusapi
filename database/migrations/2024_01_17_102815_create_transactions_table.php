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
            $table->string("amount");
            $table->string("coin_short_name")->nullable();
            $table->string("date")->nullable();
            $table->string("explorer_url")->nullable();
            $table->string("Tid")->nullable();
            $table->string("processing_fees")->nullable();
            $table->string("to_address")->nullable();
            $table->string("total_amount")->nullable();
            $table->string("transaction_fees")->nullable();
            $table->string("txid")->nullable();
            $table->string("wallet_id")->nullable();
            $table->string("wallet_name")->nullable();
            $table->string("user_id")->nullable();
            $table->string("status")->dafault(0)->nullable();
            $table->timestamps();
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
