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
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('service_category')->unique();
            $table->string('service_category_image');
            $table->string('service_category_status');
            $table->string('available_online');
            $table->string('view_swipper')->nullable();
            $table->string('view_icon_line')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('icon_class')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
