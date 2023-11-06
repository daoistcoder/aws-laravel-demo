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
        Schema::create('content_areas', function (Blueprint $table) {
            $table->id();

            $table->string('content_area_name')->nullable();
            $table->unsignedBigInteger('grade_level_id')->nullable();
            $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_areas');
    }
};
