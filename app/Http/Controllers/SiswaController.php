<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Menampilkan semua data siswa.
     */
    public function index()
    {
        $siswas = User::where('role', 'siswa')
            ->latest()
            ->get();

        return view('siswa.index', compact('siswas'));
    }

    /**
     * Menampilkan form tambah siswa.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Menyimpan akun siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Akun siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit siswa.
     */
    public function edit(User $siswa)
    {
        // Pastikan akun yang diedit adalah siswa
        if ($siswa->role !== 'siswa') {
            abort(404);
        }

        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Memperbarui data siswa.
     */
    public function update(Request $request, User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $siswa->id,
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Password hanya diperbarui jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus akun siswa.
     */
    public function destroy(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }

        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Akun siswa berhasil dihapus.');
    }
}