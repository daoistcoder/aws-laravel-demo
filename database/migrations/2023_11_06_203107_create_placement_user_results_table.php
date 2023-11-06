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
        Schema::create('placement_user_results', function (Blueprint $table) {
            $table->id();
            $table->string('user_total_correct_answer')->nullable();
            $table->unsignedBigInteger('placement_question_set_id')->nullable();
            $table->foreign('placement_question_set_id')->references('id')->on('place_question_sets')->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placement_user_results');
    }
};
