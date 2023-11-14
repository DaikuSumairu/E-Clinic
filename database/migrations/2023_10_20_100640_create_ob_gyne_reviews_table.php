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
        Schema::create('ob_gyne_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_exam_id')->nullable();  // Add medical_exam_id
            //OB-GYNE History
            $table->string('obg_lnmp')->default('No');
            $table->string('obg_ob_score')->default('No');
            $table->string('obg_abnormal_pregnancies')->default('No');
            $table->string('obg_last_delivery')->default('No');
            $table->string('obg_breast_uterus_ovaries')->default('No');

            //Review of Systems
            $table->string('rs_skin')->default('No');
            $table->string('rs_opthalmologic')->default('No');
            $table->string('rs_ent')->default('No');
            $table->string('rs_cardiovascular')->default('No');
            $table->string('rs_respiratory')->default('No');
            $table->string('rs_gastro_intestinal')->default('No');
            $table->string('rs_neuro_psychiatric')->default('No');
            $table->string('rs_hematology')->default('No');
            $table->string('rs_genitourinary')->default('No');
            $table->string('rs_musculo_skeletal')->default('No');
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
        Schema::dropIfExists('ob_gyne_reviews');
    }
};
