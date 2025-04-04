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
        Schema::table('vehicle_usages', function (Blueprint $table) {
            $table->text('return_observations')->nullable()->after('km_end');
            $table->boolean('inspection_confirmed')->default(false)->after('return_observations');
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_usages', function (Blueprint $table) {
            $table->dropColumn(['return_observations', 'inspection_confirmed']);
        });
    }
};
