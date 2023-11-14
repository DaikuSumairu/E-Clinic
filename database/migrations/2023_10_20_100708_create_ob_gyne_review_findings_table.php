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
        Schema::create('ob_gyne_review_findings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ob_gyne_review_id')->nullable();  // Add ob_gyn_review_id
            //OB-GYNE History
            $table->text('obg_lnmp_findings')->nullable();
            $table->text('obg_ob_score_findings')->nullable();
            $table->text('obg_abnormal_pregnancies_findings')->nullable();
            $table->text('obg_last_delivery_findings')->nullable();
            $table->text('obg_breast_uterus_ovaries_findings')->nullable();

            //Review of Systems
            $table->text('rs_skin_findings')->nullable();
            $table->text('rs_opthalmologic_findings')->nullable();
            $table->text('rs_ent_findings')->nullable();
            $table->text('rs_cardiovascular_findings')->nullable();
            $table->text('rs_respiratory_findings')->nullable();
            $table->text('rs_gastro_intestinal_findings')->nullable();
            $table->text('rs_neuro_psychiatric_findings')->nullable();
            $table->text('rs_hematology_findings')->nullable();
            $table->text('rs_genitourinary_findings')->nullable();
            $table->text('rs_musculo_skeletal_findings')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('ob_gyne_review_id')->references('id')->on('ob_gyne_reviews');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ob_gyne_review_findings');
    }
};
