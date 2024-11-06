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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_time');
            $table->string('status')->default('1');
            $table->string('permanently_disabled')->default('0');
            $table->string('service_sub_category');
            $table->string('service_sub_category_parent');
            $table->string('credits');
            $table->string('postcode');
            $table->string('city');
            $table->string('email');
      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
