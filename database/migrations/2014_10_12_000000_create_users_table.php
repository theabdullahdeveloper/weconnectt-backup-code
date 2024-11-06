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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('service')->nullable();
            $table->string('balance')->default('0');
            $table->string('customer_serve')->nullable();
            $table->string('miles')->nullable();
            $table->string('postcode')->nullable();
            $table->string('name')->nullable();
            $table->longText('about')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('has_website')->nullable();
            $table->string('website_link')->nullable();
            $table->string('company_size')->nullable();
            $table->string('hasSalesTeam')->nullable();
            $table->string('usesSocialMedia')->nullable();
            $table->string('email_verified');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
