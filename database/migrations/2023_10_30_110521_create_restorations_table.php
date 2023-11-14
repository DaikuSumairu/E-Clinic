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
        Schema::create('restorations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dental_exam_result_id')->nullable();  // Add dental_exam_result_id
            // Top Left
            $table->string('r_top_left_one')->default('No');
            $table->string('r_top_left_two')->default('No');
            $table->string('r_top_left_three')->default('No');
            $table->string('r_top_left_four')->default('No');
            $table->string('r_top_left_five')->default('No');
            $table->string('r_top_left_six')->default('No');
            $table->string('r_top_left_seven')->default('No');
            $table->string('r_top_left_eight')->default('No');
            
            // Top Right
            $table->string('r_top_right_one')->default('No');
            $table->string('r_top_right_two')->default('No');
            $table->string('r_top_right_three')->default('No');
            $table->string('r_top_right_four')->default('No');
            $table->string('r_top_right_five')->default('No');
            $table->string('r_top_right_six')->default('No');
            $table->string('r_top_right_seven')->default('No');
            $table->string('r_top_right_eight')->default('No');
            
            // Bot Left
            $table->string('r_bot_left_one')->default('No');
            $table->string('r_bot_left_two')->default('No');
            $table->string('r_bot_left_three')->default('No');
            $table->string('r_bot_left_four')->default('No');
            $table->string('r_bot_left_five')->default('No');
            $table->string('r_bot_left_six')->default('No');
            $table->string('r_bot_left_seven')->default('No');
            $table->string('r_bot_left_eight')->default('No');
            
            // Bot Right
            $table->string('r_bot_right_one')->default('No');
            $table->string('r_bot_right_two')->default('No');
            $table->string('r_bot_right_three')->default('No');
            $table->string('r_bot_right_four')->default('No');
            $table->string('r_bot_right_five')->default('No');
            $table->string('r_bot_right_six')->default('No');
            $table->string('r_bot_right_seven')->default('No');
            $table->string('r_bot_right_eight')->default('No');
            
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('dental_exam_result_id')->references('id')->on('dental_exam_results');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restorations');
    }
};
