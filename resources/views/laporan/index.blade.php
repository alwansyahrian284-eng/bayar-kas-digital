<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Kas - Bayar Kas Digital</title>

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
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                📊 Laporan Kas Kelas
            </h3>

            <p class="text-muted mb-0">
                Ringkasan pemasukan, pengeluaran, dan saldo kas kelas.
            </p>
        </div>

        <div class="text-end">
            <small class="text-muted d-block">
                Laporan dibuat pada
            </small>

            <span class="fw-semibold">
                {{ now()->format('d-m-Y') }}
            </span>
        </div>

    </div>


    <!-- Tombol Kembali -->
    <div class="mb-4">

        <a href="{{ route('dashboard') }}"
           class="btn btn-outline-secondary btn-sm">
            ← Kembali ke Dashboard
        </a>

    </div>


    <!-- RINGKASAN KAS -->
    <div class="row g-3 mb-4">

        <!-- Total Pemasukan -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        💰 Total Pemasukan
                    </p>

                    <h4 class="fw-bold text-success mb-1">
                        Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                    </h4>

                    <small class="text-muted">
                        {{ $jumlahPemasukan }} transaksi dikonfirmasi
                    </small>

                </div>
            </div>
        </div>


        <!-- Total Pengeluaran -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        📉 Total Pengeluaran
                    </p>

                    <h4 class="fw-bold text-danger mb-1">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </h4>

                    <small class="text-muted">
                        {{ $jumlahPengeluaran }} transaksi pengeluaran
                    </small>

                </div>
            </div>
        </div>


        <!-- Saldo Kas -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        💵 Saldo Kas Saat Ini
                    </p>

                    <h4 class="fw-bold mb-1 {{ $saldoKas < 0 ? 'text-danger' : 'text-primary' }}">
                        Rp {{ number_format($saldoKas, 0, ',', '.') }}
                    </h4>

                    <small class="text-muted">
                        Pemasukan dikurangi pengeluaran
                    </small>

                </div>
            </div>
        </div>

    </div>


    <!-- DATA PEMASUKAN -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="fw-bold mb-0">
                    💰 Data Pemasukan
                </h5>

                <span class="badge text-bg-success">
                    {{ $jumlahPemasukan }} Transaksi
                </span>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pemasukans as $pemasukan)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $pemasukan->user->name ?? '-' }}
                                </td>

                                <td>
                                    @if($pemasukan->tanggal)
                                        {{ \Carbon\Carbon::parse($pemasukan->tanggal)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="fw-semibold text-success">
                                    Rp {{ number_format($pemasukan->nominal, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $pemasukan->keterangan ?? '-' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center text-muted py-4">

                                    Belum ada pemasukan yang dikonfirmasi.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- DATA PENGELUARAN -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="fw-bold mb-0">
                    📉 Data Pengeluaran
                </h5>

                <span class="badge text-bg-danger">
                    {{ $jumlahPengeluaran }} Transaksi
                </span>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

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

                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $pengeluaran->nama_pengeluaran }}
                                </td>

                                <td>
                                    @if($pengeluaran->tanggal)
                                        {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="fw-semibold text-danger">
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

</body>
</html>