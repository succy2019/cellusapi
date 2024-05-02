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
        Schema::create('transaction_responses', function (Blueprint $table) {
            $table->string('id')->unique();
            // $table->string('id');
            $table->string('txid')->nullable();
            $table->string('explorer_url')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('type')->nullable();
            $table->string('coin_short_name')->nullable();
            $table->string('wallet_id')->nullable();
            $table->string('wallet_name')->nullable();
            $table->string('address_label')->nullable();
            $table->string('address')->nullable();
            $table->string('amount')->nullable();
            $table->string('confirmations')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_responses');
    }
};
