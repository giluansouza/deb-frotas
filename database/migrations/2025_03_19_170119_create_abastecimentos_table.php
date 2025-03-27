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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->string('gas_station');
            $table->string('fuel_type');
            $table->unsignedSmallInteger('quantity');
            $table->decimal('unit_value', 8, 2);
            $table->decimal('total_value', 8, 2);
            $table->unsignedInteger('current_km');
            $table->dateTime('supply_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
