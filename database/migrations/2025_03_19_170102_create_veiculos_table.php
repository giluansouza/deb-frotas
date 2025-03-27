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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 7)->unique();
            $table->string('renavam', 11)->unique();
            $table->string('model');
            $table->unsignedSmallInteger('year_manufacture');
            $table->unsignedSmallInteger('year_model');
            $table->string('type');
            $table->string('fuel_type');
            $table->unsignedSmallInteger('tank_capacity');
            $table->string('administrative_unit');
            $table->string('ownership');
            $table->string('conservation_state');
            $table->boolean('visual_identity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
