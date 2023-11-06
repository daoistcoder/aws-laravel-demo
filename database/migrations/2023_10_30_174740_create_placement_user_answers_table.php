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
        Schema::create('placement_user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_question_id');
            $table->unsignedBigInteger('place_choice_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_answer')->default(''); // Change the data type as needed
            $table->timestamps();

            $table->foreign('place_question_id')->references('id')->on('place_questions');
            $table->foreign('place_choice_id')->references('id')->on('place_choices');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placement_user_answers');
    }
};
