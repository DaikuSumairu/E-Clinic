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
        Schema::create('inventory_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id')->nullable();  // Add inventory_id
            $table->string('name');
            $table->enum('type',['Medicine', 'Equipment']);
            $table->integer('dosage')->default(0);
            $table->integer('quantity')->default(0);
            $table->timestamps();
            
            // Add foreign key constraint 
            $table->foreign('inventory_id')->references('id')->on('inventories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_infos');
    }
};
