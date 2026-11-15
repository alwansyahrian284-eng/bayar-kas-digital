<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">

        <a href="{{ route('dashboard') }}"
           class="navbar-brand fw-bold text-decoration-none">
            💰 Bayar Kas Digital
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-light btn-sm">
                Logout
            </button>
        </form>

    </div>
</nav>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Data Siswa</h3>
            <p class="text-muted mb-0">
                Kelola akun siswa yang terdaftar.
            </p>
        </div>

        <a href="{{ route('siswa.create') }}"
           class="btn btn-primary">
            ➕ Tambah Siswa
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($siswas as $siswa)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $siswa->name }}
                                </td>

                                <td>
                                    {{ $siswa->email }}
                                </td>

                                <td>
                                    {{ $siswa->created_at->format('d-m-Y') }}
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('siswa.edit', $siswa->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('siswa.destroy', $siswa->id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus akun siswa ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center text-muted py-4">
                                    Belum ada akun siswa.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

</body>
</html>