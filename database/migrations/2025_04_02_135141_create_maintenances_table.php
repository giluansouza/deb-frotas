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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->restrictOnDelete();
            $table->foreignId('repair_shop_id')->constrained()->restrictOnDelete();
            $table->foreignId('authorized_by')->constrained('users')->restrictOnDelete();
            $table->string('type');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('odometer');
            $table->text('problem_description');
            $table->text('solution_description')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
