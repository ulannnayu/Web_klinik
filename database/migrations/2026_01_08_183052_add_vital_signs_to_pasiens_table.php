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
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('tensi_darah')->nullable();
            $table->integer('berat_badan')->nullable(); // kg
            $table->integer('tinggi_badan')->nullable(); // cm
            $table->decimal('suhu_tubuh', 4, 1)->nullable(); // Celcius
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            //
        });
    }
};
