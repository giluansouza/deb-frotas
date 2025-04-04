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
        Schema::create('vehicle_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->restrictOnDelete();
            $table->foreignId('driver_id')->constrained()->restrictOnDelete();

            $table->foreignId('requested_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('authorized_by')->nullable()->constrained('users')->restrictOnDelete();
            $table->foreignId('garage_out_by')->nullable()->constrained('users')->restrictOnDelete();
            $table->foreignId('garage_in_by')->nullable()->constrained('users')->restrictOnDelete();

            $table->string('unit_name');
            $table->string('purpose');
            $table->string('destination');
            $table->dateTime('departure_datetime');
            $table->dateTime('return_datetime')->nullable();

            $table->integer('km_start')->nullable();
            $table->integer('km_end')->nullable();

            $table->text('observations')->nullable();
            $table->text('rejection_reason')->nullable(); // <-- Adicionado

            $table->string('status')->default('requested');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_usages');
    }
};
