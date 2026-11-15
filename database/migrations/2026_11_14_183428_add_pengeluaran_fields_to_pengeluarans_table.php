<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {

            if (!Schema::hasColumn('pengeluarans', 'nama_pengeluaran')) {
                $table->string('nama_pengeluaran')->nullable();
            }

            if (!Schema::hasColumn('pengeluarans', 'tanggal')) {
                $table->date('tanggal')->nullable();
            }

            if (!Schema::hasColumn('pengeluarans', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('pengeluarans', 'nama_pengeluaran')) {
                $columns[] = 'nama_pengeluaran';
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