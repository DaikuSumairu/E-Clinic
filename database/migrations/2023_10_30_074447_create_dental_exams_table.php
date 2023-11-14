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
        Schema::create('dental_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id')->nullable();  // Add record_id
            $table->date('date_created')->nullable();
            $table->date('date_updated')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('record_id')->references('id')->on('records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dental_exams');
    }
};
