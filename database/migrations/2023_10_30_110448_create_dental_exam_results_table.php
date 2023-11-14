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
        Schema::create('dental_exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dental_exam_id')->nullable();  // Add dental_exam_id
            $table->enum('oral_hygiene', ['Good', 'Fair', 'Poor']);
            $table->enum('gingival_color', ['Pink', 'Pale', 'Bright Red']);
            $table->enum('consistency_of_the_gingiva', ['Firm', 'Smooth', 'Enlarge']);
            $table->string('oral_prophylaxis')->default('No');
            $table->text('oral_prophylaxis_result')->nullable();
            $table->string('restoration')->default('No');
            $table->string('extraction')->default('No');
            $table->string('prosthodontic_restoration')->default('No');
            $table->text('prosthodontic_restoration_result')->nullable();
            $table->string('orthodontist')->default('No');
            $table->text('orthodontist_result')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('dental_exam_id')->references('id')->on('dental_exams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dental_exam_results');
    }
};
