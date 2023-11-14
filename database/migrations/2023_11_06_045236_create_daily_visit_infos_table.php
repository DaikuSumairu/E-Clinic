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
        Schema::create('daily_visit_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daily_visit_id')->nullable();  // Add daily_visit_id
            $table->string('main_complaint');
            $table->string('sub_complaint');
            $table->text('treatment')->nullable();
            $table->string('medicine')->default('No');
            $table->integer('medicine_take')->nullable();
            $table->string('take')->nullable();
            $table->timestamps();

            // Add foreign key constraint 
            $table->foreign('daily_visit_id')->references('id')->on('daily_visits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_visit_infos');
    }
};
