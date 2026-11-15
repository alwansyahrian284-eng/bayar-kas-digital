<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom yang diperlukan ke tabel pengeluarans.
     */
    public function up(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {

            if (!Schema::hasColumn('pengeluarans', 'nama_pengeluaran')) {
                $table->string('nama_pengeluaran');
            }

            if (!Schema::hasColumn('pengeluarans', 'nominal')) {
                $table->decimal('nominal', 15, 2);
            }

            if (!Schema::hasColumn('pengeluarans', 'tanggal')) {
                $table->date('tanggal');
            }

            if (!Schema::hasColumn('pengeluarans', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }

        });
    }

    /**
     * Menghapus kolom jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('pengeluarans', 'nama_pengeluaran')) {
                $columns[] = 'nama_pengeluaran';
            }

            if (Schema::hasColumn('pengeluarans', 'nominal')) {
                $columns[] = 'nominal';
            }

            if (Schema::hasColumn('pengeluarans', 'tanggal')) {
                $columns[] = 'tanggal';
            }

            if (Schema::hasColumn('pengeluarans', 'keterangan')) {
                $columns[] = 'keterangan';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};