<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2);
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });
    }
};