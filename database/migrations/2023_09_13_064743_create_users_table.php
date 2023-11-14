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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable();  // Add role_id
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('school_id')->nullable(); //ID
            $table->enum('course', ['BSCS', 'BSIT'])->nullable();
            $table->enum('specialization', ['Computer Science',])->nullable();
            $table->enum('grade', ['11', '12'])->nullable();
            $table->enum('year', ['1st', '2nd', '3rd', '4th'])->nullable();
            $table->string('section')->nullable();
            $table->timestamps();

            // Add foreign key constraint 
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
