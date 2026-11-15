<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    /**
     * Menampilkan ringkasan laporan kas kelas.
     */
    public function index()
    {
        // Total pemasukan dari pembayaran
        // yang sudah dikonfirmasi oleh Bendahara
        $totalPemasukan = Pembayaran::where('status', 'dikonfirmasi')
            ->sum('nominal');

        // Total seluruh pengeluaran
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // Saldo kas saat ini
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        // Daftar pemasukan yang sudah dikonfirmasi
        $pemasukans = Pembayaran::with('user')
            ->where('status', 'dikonfirmasi')
            ->latest('tanggal')
            ->get();

        // Daftar pengeluaran
        $pengeluarans = Pengeluaran::latest('tanggal')
            ->get();

        // Jumlah transaksi
        $jumlahPemasukan = $pemasukans->count();
        $jumlahPengeluaran = $pengeluarans->count();

        return view('laporan.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'pemasukans',
            'pengeluarans',
            'jumlahPemasukan',
            'jumlahPengeluaran'
        ));
    }
}