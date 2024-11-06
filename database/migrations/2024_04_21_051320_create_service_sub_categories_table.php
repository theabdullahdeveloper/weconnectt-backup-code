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
        Schema::create('service_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('service_sub_category')->unique();
            $table->string('service_sub_category_parent');
            $table->string('service_sub_category_image');
            $table->string('service_sub_category_status');
            $table->string('sub_category_available_online');
            $table->string('sub_category_view_index_page');
            $table->string('sub_category_icon_class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_sub_categories');
    }
};
