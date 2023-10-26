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
        Schema::create('place_sub_topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('sub_topic_name')->nullable();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->foreign('topic_id')->references('id')->on('place_topics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_sub_topics');
    }
};
