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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->unique();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['role' => 'No Role'],
            ['role' => 'Student'],
            ['role' => 'Faculty'],
            ['role' => 'Staff'],
            ['role' => 'Nurse'],
            ['role' => 'Doctor'],
            ['role' => 'Dentist'],
            ['role' => 'Admin'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
