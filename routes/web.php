<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| HEALTH CHECK
|--------------------------------------------------------------------------
| Route khusus untuk mengecek apakah aplikasi berjalan dengan baik
| di server EthioDeploy.
*/

Route::get('/health', function () {
    return response('OK', 200);
});


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

});


/*
|--------------------------------------------------------------------------
| USER YANG SUDAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | BENDAHARA
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:bendahara')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        Route::get('/siswa', [SiswaController::class, 'index'])
            ->name('siswa.index');

        Route::get('/siswa/tambah', [SiswaController::class, 'create'])
            ->name('siswa.create');

        Route::post('/siswa', [SiswaController::class, 'store'])
            ->name('siswa.store');

        Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])
            ->name('siswa.edit');

        Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])
            ->name('siswa.update');

        Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])
            ->name('siswa.destroy');


        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN KAS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/bendahara/pembayaran',
            [PembayaranController::class, 'index']
        )->name('bendahara.pembayaran.index');

        Route::put(
            '/bendahara/pembayaran/{pembayaran}/konfirmasi',
            [PembayaranController::class, 'konfirmasi']
        )->name('bendahara.pembayaran.konfirmasi');

        Route::put(
            '/bendahara/pembayaran/{pembayaran}/tolak',
            [PembayaranController::class, 'tolak']
        )->name('bendahara.pembayaran.tolak');

        Route::delete(
            '/bendahara/pembayaran/{pembayaran}',
            [PembayaranController::class, 'destroy']
        )->name('bendahara.pembayaran.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENGELUARAN KAS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/bendahara/pengeluaran',
            [PengeluaranController::class, 'index']
        )->name('pengeluaran.index');

        Route::get(
            '/bendahara/pengeluaran/tambah',
            [PengeluaranController::class, 'create']
        )->name('pengeluaran.create');

        Route::post(
            '/bendahara/pengeluaran',
            [PengeluaranController::class, 'store']
        )->name('pengeluaran.store');

        Route::delete(
            '/bendahara/pengeluaran/{pengeluaran}',
            [PengeluaranController::class, 'destroy']
        )->name('pengeluaran.destroy');


        /*
        |--------------------------------------------------------------------------
        | LAPORAN KAS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/bendahara/laporan',
            [LaporanController::class, 'index']
        )->name('laporan.index');

    });


    /*
    |--------------------------------------------------------------------------
    | WALIKELAS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:walikelas')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | PEMASUKAN KAS
        |--------------------------------------------------------------------------
        | Wali Kelas hanya dapat melihat pembayaran yang sudah dikonfirmasi.
        */

        Route::get(
            '/walikelas/pemasukan',
            [PembayaranController::class, 'walikelasPemasukan']
        )->name('walikelas.pemasukan');


        /*
        |--------------------------------------------------------------------------
        | PENGELUARAN KAS
        |--------------------------------------------------------------------------
        | Wali Kelas hanya dapat melihat data pengeluaran.
        */

        Route::get(
            '/walikelas/pengeluaran',
            [PengeluaranController::class, 'walikelasIndex']
        )->name('walikelas.pengeluaran');


        /*
        |--------------------------------------------------------------------------
        | SALDO KAS
        |--------------------------------------------------------------------------
        | Wali Kelas dapat melihat ringkasan saldo kas.
        */

        Route::get(
            '/walikelas/saldo',
            [DashboardController::class, 'walikelasSaldo']
        )->name('walikelas.saldo');

    });


    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:siswa')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN KAS SISWA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/siswa/pembayaran',
            [PembayaranController::class, 'index']
        )->name('siswa.pembayaran.index');

        Route::get(
            '/siswa/pembayaran/bayar',
            [PembayaranController::class, 'create']
        )->name('siswa.pembayaran.create');

        Route::post(
            '/siswa/pembayaran',
            [PembayaranController::class, 'store']
        )->name('siswa.pembayaran.store');

    });

});