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
        Schema::create('reduce_quantities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_info_id')->nullable();  // Add inventory_info_id
            $table->integer('reduce_quantity')->default(0);
            $table->timestamps();
            
            // Add foreign key constraint 
            $table->foreign('inventory_info_id')->references('id')->on('inventory_infos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reduce_quantities');
    }
};
