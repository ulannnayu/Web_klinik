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
            $table->string('no_bpjs')->nullable()->after('alamat');
            $table->enum('tipe_pasien', ['umum', 'bpjs'])->default('umum')->after('no_bpjs');
            $table->string('status_pembayaran')->nullable()->after('status'); // lunas, pending, null
            
            // Note: We'll modify the existing 'status' enum logically, 
            // but since SQLite/MySQL handled enums differently, we might just use string logic for status.
            // Or we assume the existing status column can handle new string values if it's not strict ENUM in DB.
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
