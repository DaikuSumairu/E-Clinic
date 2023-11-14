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
        Schema::create('family_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_exam_id')->nullable();  // Add medical_exam_id
            $table->string('fh_bronchial_asthma')->default('No');
            $table->string('fh_diabetes_mellitus')->default('No');
            $table->string('fh_thyroid_disease')->default('No');
            $table->string('fh_opthalmologic_disease')->default('No');
            $table->string('fh_cancer')->default('No');
            $table->string('fh_cardiac_disorder')->default('No');
            $table->string('fh_hypertension')->default('No');
            $table->string('fh_tuberculosis')->default('No');
            $table->string('fh_nervous_disorder')->default('No');
            $table->string('fh_musculoskeletal')->default('No');
            $table->string('fh_liver_disease')->default('No');
            $table->string('fh_kidney_disease')->default('No');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('medical_exam_id')->references('id')->on('medical_exams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_histories');
    }
};
