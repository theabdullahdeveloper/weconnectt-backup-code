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
        Schema::create('user_credit_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('payment_date');
            $table->string('payment_amount');
            $table->string('currency');
            $table->string('credits_purchased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_credit_details');
    }
};
