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
        Schema::create('consultation_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultation_id')->nullable();  // Add consultation_id
            $table->text('complaint');
            $table->integer('pulse');
            $table->integer('oxygen');
            $table->integer('respiratory_rate');
            $table->integer('top_bp');
            $table->integer('bot_bp');
            $table->float('temperature');
            $table->text('treatment');
            $table->string('remarks');
            $table->timestamps();
            
            // Add foreign key constraint
            $table->foreign('consultation_id')->references('id')->on('consultations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_responses');
    }
};
