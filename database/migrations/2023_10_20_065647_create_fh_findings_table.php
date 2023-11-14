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
        Schema::create('family_history_findings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_history_id')->nullable();  // Add family_history_id
            $table->text('fh_bronchial_asthma_findings')->nullable();
            $table->text('fh_diabetes_mellitus_findings')->nullable();
            $table->text('fh_thyroid_disease_findings')->nullable();
            $table->text('fh_opthalmologic_disease_findings')->nullable();
            $table->text('fh_cancer_findings')->nullable();
            $table->text('fh_cardiac_disorder_findings')->nullable();
            $table->text('fh_hypertension_findings')->nullable();
            $table->text('fh_tuberculosis_findings')->nullable();
            $table->text('fh_nervous_disorder_findings')->nullable();
            $table->text('fh_musculoskeletal_findings')->nullable();
            $table->text('fh_liver_disease_findings')->nullable();
            $table->text('fh_kidney_disease_findings')->nullable();
            $table->text('fh_others')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('family_history_id')->references('id')->on('family_histories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_history_findings');
    }
};
