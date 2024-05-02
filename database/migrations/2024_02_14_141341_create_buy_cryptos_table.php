<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buy_cryptos', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->nullable();
            $table->string("amount")->nullable();
            $table->string("network")->nullable();
            $table->string("status")->default(0)->nullable();
            $table->string("type");
            $table->string("to_pay");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_cryptos');
    }
};
