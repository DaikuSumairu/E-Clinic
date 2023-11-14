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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();  // Add user_id
            $table->date('birth_date');
            $table->tinyInteger('age')->unsigned();
            $table->enum('sex', ['Male', 'Female']);
            $table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->string('address');
            $table->string('street');
            $table->string('city');
            $table->string('province');
            $table->string('zip');
            $table->string('mobile_number');
            $table->string('contact_person');
            $table->string('contact_person_number');
            $table->timestamps();

            // Add foreign key constraint 
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
