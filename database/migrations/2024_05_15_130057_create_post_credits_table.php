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
        Schema::create('post_credits', function (Blueprint $table) {
            $table->id();
            $table->string('service_sub_category');
            $table->string('service_sub_category_parent');
            $table->string('credit_question');
            $table->string('credit_answer');
            $table->string('credits');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_credits');
    }
};
