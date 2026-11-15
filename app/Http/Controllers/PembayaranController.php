<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Menampilkan data pembayaran.
     * Siswa hanya melihat pembayaran miliknya.
     * Bendahara melihat seluruh pembayaran.
     */
    public function index()
    {
        $user = auth()->user();

        // Jika yang login adalah siswa
        if ($user->role === 'siswa') {
            $pembayarans = Pembayaran::where('user_id', $user->id)
                ->latest()
                ->get();

            return view('pembayaran.index', compact('pembayarans'));
        }

        // Jika yang login adalah bendahara
        if ($user->role === 'bendahara') {
            $pembayarans = Pembayaran::with('user')
                ->latest()
                ->get();

            return view('pembayaran.index', compact('pembayarans'));
        }

        abort(403, 'ANDA TIDAK PUNYA AKSES KE HALAMAN INI.');
    }


    /**
     * Menampilkan halaman form pembayaran untuk siswa.
     */
    public function create()
    {
        return view('pembayaran.create');
    }


    /**
     * Menyimpan pembayaran baru dari siswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nominal' => ['required', 'numeric', 'min:1000'],
            'tanggal' => ['required', 'date'],
            'bukti_pembayaran' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        // Menyimpan file bukti pembayaran
        $buktiPembayaran = $request
            ->file('bukti_pembayaran')
            ->store('bukti-pembayaran', 'public');

        // Menyimpan data pembayaran
        Pembayaran::create([
            'user_id' => auth()->id(),
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'bukti_pembayaran' => $buktiPembayaran,
            'keterangan' => $request->keterangan,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('siswa.pembayaran.index')
            ->with(
                'success',
                'Pembayaran berhasil dikirim dan sedang menunggu konfirmasi Bendahara.'
            );
    }


    /**
     * Mengonfirmasi pembayaran siswa.
     */
    public function konfirmasi(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'dikonfirmasi',
        ]);

        return redirect()
            ->route('bendahara.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }


    /**
     * Menolak pembayaran siswa.
     */
    public function tolak(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'ditolak',
        ]);

        return redirect()
            ->route('bendahara.pembayaran.index')
            ->with('success', 'Pembayaran telah ditolak.');
    }


    /**
     * Menghapus pembayaran siswa.
     * File bukti pembayaran juga akan dihapus dari storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        // Hapus file bukti pembayaran jika tersedia
        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete(
                $pembayaran->bukti_pembayaran
            );
        }

        // Hapus data pembayaran dari database
        $pembayaran->delete();

        return redirect()
            ->route('bendahara.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
    }


    /**
     * Menampilkan data pemasukan kas untuk Wali Kelas.
     * Hanya pembayaran yang sudah dikonfirmasi.
     */
    public function walikelasPemasukan()
    {
        $pembayarans = Pembayaran::with('user')
            ->where('status', 'dikonfirmasi')
            ->latest()
            ->get();

        return view(
            'pembayaran.walikelas-pemasukan',
            compact('pembayarans')
        );
    }
}