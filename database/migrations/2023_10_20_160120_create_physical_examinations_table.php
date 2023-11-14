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
        Schema::create('physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_exam_id')->nullable();  // Add medical_exam_id
            //Primary
            $table->integer('height');
            $table->integer('weight');
            $table->integer('top_bp');
            $table->integer('bot_bp');
            $table->integer('pulse');
            $table->integer('respiratory_rate');
            $table->float('bmi');

            //Secondary
            $table->string('pe_general_appearance')->default('No');
            $table->string('pe_skin')->default('No');
            $table->string('pe_head_scalp')->default('No');
            $table->string('pe_eyes')->default('No');
            $table->string('pe_corrected')->default('No');
            $table->string('pe_pupils')->default('No');
            $table->string('pe_ear_eardrums')->default('No');
            $table->string('pe_nose_sinuses')->default('No');
            $table->string('pe_mouth_throat')->default('No');
            $table->string('pe_neck_thyroid')->default('No');
            $table->string('pe_chest_breast_axilla')->default('No');
            $table->string('pe_heart_cardiovascular')->default('No');
            $table->string('pe_lungs_respiratory')->default('No');
            $table->string('pe_abdomen')->default('No');
            $table->string('pe_back_flanks')->default('No');
            $table->string('pe_anus_rectum')->default('No');
            $table->string('pe_genito_urinary_system')->default('No');
            $table->string('pe_inguinal_genitals')->default('No');
            $table->string('pe_musculo_skeletal')->default('No');
            $table->string('pe_extremities')->default('No');
            $table->string('pe_reflexes')->default('No');
            $table->string('pe_neurological')->default('No');
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
        Schema::dropIfExists('physical_examinations');
    }
};
