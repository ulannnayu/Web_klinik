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
            // Make nomor_antrian nullable
            $table->string('nomor_antrian')->nullable()->change();
            
            // Change status to string to allow 'menunggu_pembayaran' without enum constraint issues in SQLite
            // Note: In SQLite, changing column type might require full table recreation, 
            // but Laravel/DBAL handles this.
            $table->string('status')->default('menunggu')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('nomor_antrian')->nullable(false)->change();
            // Reverting status to enum might be complex in SQLite, skipping strict revert for now to avoid data loss
        });
    }
};
