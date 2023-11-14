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
        Schema::create('physical_examination_findings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('physical_examination_id')->nullable();  // Add physical_examination_id
            $table->text('pe_general_appearance_findings')->nullable();
            $table->text('pe_skin_findings')->nullable();
            $table->text('pe_head_scalp_findings')->nullable();

            //Eyes and Corrected findings
            $table->integer('pe_eyes_top_od')->nullable();
            $table->integer('pe_eyes_bot_od')->nullable();
            $table->integer('pe_eyes_top_os')->nullable();
            $table->integer('pe_eyes_bot_os')->nullable();
            $table->integer('pe_corrected_top_od')->nullable();
            $table->integer('pe_corrected_bot_od')->nullable();
            $table->integer('pe_corrected_top_os')->nullable();
            $table->integer('pe_corrected_bot_os')->nullable();

            $table->text('pe_pupils_findings')->nullable();
            $table->text('pe_ear_eardrums_findings')->nullable();
            $table->text('pe_nose_sinuses_findings')->nullable();
            $table->text('pe_mouth_throat_findings')->nullable();
            $table->text('pe_neck_thyroid_findings')->nullable();
            $table->text('pe_chest_breast_axilla_findings')->nullable();
            $table->text('pe_heart_cardiovascular_findings')->nullable();
            $table->text('pe_lungs_respiratory_findings')->nullable();
            $table->text('pe_abdomen_findings')->nullable();
            $table->text('pe_back_flanks_findings')->nullable();
            $table->text('pe_anus_rectum_findings')->nullable();
            $table->text('pe_genito_urinary_system_findings')->nullable();
            $table->text('pe_inguinal_genitals_findings')->nullable();
            $table->text('pe_musculo_skeletal_findings')->nullable();
            $table->text('pe_extremities_findings')->nullable();
            $table->text('pe_reflexes_findings')->nullable();
            $table->text('pe_neurological_findings')->nullable();
            $table->text('diagnosis')->nullable();
            $table->timestamps();
            
            // Add foreign key constraint
            $table->foreign('physical_examination_id')->references('id')->on('physical_examinations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_examination_findings');
    }
};
