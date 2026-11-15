<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Menampilkan semua data pengeluaran untuk Bendahara.
     */
    public function index()
    {
        $pengeluarans = Pengeluaran::latest()
            ->get();

        return view('pengeluaran.index', compact('pengeluarans'));
    }


    /**
     * Menampilkan halaman tambah pengeluaran.
     */
    public function create()
    {
        return view('pengeluaran.create');
    }


    /**
     * Menyimpan data pengeluaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'numeric', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Pengeluaran::create([
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }


    /**
     * Menghapus data pengeluaran.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }


    /**
     * Menampilkan data pengeluaran khusus untuk Wali Kelas.
     * Wali Kelas hanya dapat melihat data, tanpa menambah
     * atau menghapus pengeluaran.
     */
    public function walikelasIndex()
    {
        $pengeluarans = Pengeluaran::latest()
            ->get();

        return view(
            'pengeluaran.walikelas',
            compact('pengeluarans')
        );
    }
}