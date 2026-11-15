<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pengeluaran Kas - Bayar Kas Digital</title>

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

    <!-- Judul Halaman -->
    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            📉 Data Pengeluaran Kas
        </h3>

        <p class="text-muted mb-0">
            Berikut adalah daftar pengeluaran kas kelas.
        </p>

    </div>


    <!-- Tabel Pengeluaran -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengeluaran</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
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

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center text-muted py-4">

                                    Belum ada data pengeluaran kas.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Tombol Kembali -->
    <div class="mt-3">

        <a href="{{ route('dashboard') }}"
           class="btn btn-secondary">

            ← Kembali ke Dashboard

        </a>

    </div>

</div>

</body>
</html>