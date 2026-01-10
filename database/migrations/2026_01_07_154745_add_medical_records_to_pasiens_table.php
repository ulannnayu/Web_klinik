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
            $table->text('diagnosa')->nullable()->after('status_pembayaran');
            $table->text('tindakan')->nullable()->after('diagnosa');
            $table->text('resep_obat')->nullable()->after('tindakan');
            $table->text('catatan_dokter')->nullable()->after('resep_obat');
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
