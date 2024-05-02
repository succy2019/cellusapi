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
        Schema::create('usercredentials', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('bvn_number');
            $table->string('nin_number');
            $table->string('address');
            $table->string('bvn_document');
            $table->string('nin_document');
            $table->string('proof_of_address');
            $table->string('account_level');
            $table->string('kyc_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usercredentials');
    }
};
