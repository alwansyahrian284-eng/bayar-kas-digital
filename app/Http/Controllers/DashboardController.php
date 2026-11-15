<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD BENDAHARA
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'bendahara') {

            $labels = [];
            $dataPemasukan = [];
            $dataPengeluaran = [];
            $dataSaldo = [];

            for ($i = 3; $i >= 0; $i--) {

                $awalMinggu = Carbon::now()
                    ->subWeeks($i)
                    ->startOfWeek();

                $akhirMinggu = Carbon::now()
                    ->subWeeks($i)
                    ->endOfWeek();

                $labels[] = $awalMinggu->format('d M')
                    . ' - '
                    . $akhirMinggu->format('d M');

                $pemasukan = Pembayaran::where('status', 'dikonfirmasi')
                    ->whereBetween('tanggal', [
                        $awalMinggu->copy()->startOfDay(),
                        $akhirMinggu->copy()->endOfDay(),
                    ])
                    ->sum('nominal');

                $pengeluaran = Pengeluaran::whereBetween('tanggal', [
                    $awalMinggu->copy()->startOfDay(),
                    $akhirMinggu->copy()->endOfDay(),
                ])->sum('nominal');

                $saldo = $pemasukan - $pengeluaran;

                $dataPemasukan[] = $pemasukan;
                $dataPengeluaran[] = $pengeluaran;
                $dataSaldo[] = $saldo;
            }

            return view('dashboard.bendahara', compact(
                'labels',
                'dataPemasukan',
                'dataPengeluaran',
                'dataSaldo'
            ));
        }


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD WALIKELAS
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'walikelas') {

            $labels = [];
            $dataPemasukan = [];
            $dataPengeluaran = [];
            $dataSaldo = [];

            for ($i = 3; $i >= 0; $i--) {

                $awalMinggu = Carbon::now()
                    ->subWeeks($i)
                    ->startOfWeek();

                $akhirMinggu = Carbon::now()
                    ->subWeeks($i)
                    ->endOfWeek();

                $labels[] = $awalMinggu->format('d M')
                    . ' - '
                    . $akhirMinggu->format('d M');

                $pemasukan = Pembayaran::where('status', 'dikonfirmasi')
                    ->whereBetween('tanggal', [
                        $awalMinggu->copy()->startOfDay(),
                        $akhirMinggu->copy()->endOfDay(),
                    ])
                    ->sum('nominal');

                $pengeluaran = Pengeluaran::whereBetween('tanggal', [
                    $awalMinggu->copy()->startOfDay(),
                    $akhirMinggu->copy()->endOfDay(),
                ])->sum('nominal');

                $saldo = $pemasukan - $pengeluaran;

                $dataPemasukan[] = $pemasukan;
                $dataPengeluaran[] = $pengeluaran;
                $dataSaldo[] = $saldo;
            }

            return view('dashboard.walikelas', compact(
                'labels',
                'dataPemasukan',
                'dataPengeluaran',
                'dataSaldo'
            ));
        }


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD SISWA
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'siswa') {
            return view('dashboard.siswa');
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK DIKENALI
        |--------------------------------------------------------------------------
        */

        abort(403, 'Role pengguna tidak dikenali.');
    }


    /*
    |--------------------------------------------------------------------------
    | SALDO KAS WALIKELAS
    |--------------------------------------------------------------------------
    | Menampilkan total pemasukan, pengeluaran, dan saldo kas.
    */

    public function walikelasSaldo()
    {
        // Total pembayaran yang sudah dikonfirmasi
        $totalPemasukan = Pembayaran::where('status', 'dikonfirmasi')
            ->sum('nominal');

        // Total seluruh pengeluaran kas
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // Menghitung saldo kas
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('dashboard.walikelas-saldo', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));
    }
}