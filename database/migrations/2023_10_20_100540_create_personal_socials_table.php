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
        Schema::create('personal_socials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_exam_id')->nullable();  // Add medical_exam_id
            //Personal and Social History
            $table->string('smoker')->default('No');
            $table->integer('day')->nullable();
            $table->integer('year')->nullable();
            $table->string('alcoholic')->default('No');
            $table->integer('shot')->nullable();
            $table->integer('week')->nullable();
            $table->string('medication')->default('No');
            $table->text('med_take')->nullable();
            //Hospitalization and Operation
            $table->string('hospitalization')->default('No');
            $table->integer('hospitalization_result')->nullable();
            $table->string('operation')->default('No');
            $table->integer('operation_result')->nullable();
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
        Schema::dropIfExists('personal_socials');
    }
};
