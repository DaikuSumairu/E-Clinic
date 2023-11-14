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
        Schema::create('past_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_exam_id')->nullable();  // Add medical_exam_id
            $table->string('pmh_allergies')->default('No');
            $table->string('pmh_skin_disease')->default('No');
            $table->string('pmh_opthalmologic_disorder')->default('No');
            $table->string('pmh_ent_disorder')->default('No');
            $table->string('pmh_bronchial_asthma')->default('No');
            $table->string('pmh_cardiac_disorder')->default('No');
            $table->string('pmh_diabetes_mellitus')->default('No');
            $table->string('pmh_chronic_headache')->default('No');
            $table->string('pmh_hepatitis')->default('No');
            $table->string('pmh_hypertension')->default('No');
            $table->string('pmh_thyroid_disorder')->default('No');
            $table->string('pmh_blood_disorder')->default('No');
            $table->string('pmh_tuberculosis')->default('No');
            $table->string('pmh_peptic_ulcer')->default('No');
            $table->string('pmh_musculoskeletal_disorder')->default('No');
            $table->string('pmh_infectious_disease')->default('No');
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
        Schema::dropIfExists('past_medical_histories');
    }
};
