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
        Schema::create('question_answer_by_user_for_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); // Correct column name
            $table->string('question');
            $table->text('answer');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Correct foreign key reference
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_answer_by_user_for_posts');
    }
};
