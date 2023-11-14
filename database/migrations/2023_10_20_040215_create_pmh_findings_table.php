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
        Schema::create('past_medical_history_findings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('past_medical_history_id')->nullable();  // Add past_medical_history_id
            $table->text('pmh_allergies_findings')->nullable();
            $table->text('pmh_skin_disease_findings')->nullable();
            $table->text('pmh_opthalmologic_disorder_findings')->nullable();
            $table->text('pmh_ent_disorder_findings')->nullable();
            $table->text('pmh_bronchial_asthma_findings')->nullable();
            $table->text('pmh_cardiac_disorder_findings')->nullable();
            $table->text('pmh_diabetes_mellitus_findings')->nullable();
            $table->text('pmh_chronic_headache_findings')->nullable();
            $table->text('pmh_hepatitis_findings')->nullable();
            $table->text('pmh_hypertension_findings')->nullable();
            $table->text('pmh_thyroid_disorder_findings')->nullable();
            $table->text('pmh_blood_disorder_findings')->nullable();
            $table->text('pmh_tuberculosis_findings')->nullable();
            $table->text('pmh_peptic_ulcer_findings')->nullable();
            $table->text('pmh_musculoskeletal_disorder_findings')->nullable();
            $table->text('pmh_infectious_disease_findings')->nullable();
            $table->text('pmh_others')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('past_medical_history_id')->references('id')->on('past_medical_histories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('past_medical_history_findings');
    }
};
