<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengeluaran Kas - Bayar Kas Digital</title>

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

    <!-- Judul dan tombol tambah -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                📉 Data Pengeluaran Kas
            </h3>

            <p class="text-muted mb-0">
                Kelola seluruh data pengeluaran kas kelas.
            </p>
        </div>

        <a href="{{ route('pengeluaran.create') }}"
           class="btn btn-primary">
            + Tambah Pengeluaran
        </a>

    </div>


    <!-- Pesan berhasil -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- Tabel Pengeluaran -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengeluaran</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pengeluarans as $pengeluaran)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $pengeluaran->nama_pengeluaran }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d-m-Y') }}
                                </td>

                                <td>
                                    Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $pengeluaran->keterangan ?? '-' }}
                                </td>

                                <td class="text-center">

                                    <form method="POST"
                                          action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus data pengeluaran ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center text-muted py-4">

                                    Belum ada data pengeluaran.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>