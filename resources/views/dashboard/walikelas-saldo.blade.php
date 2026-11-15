<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Saldo Kas - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success">
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
            💵 Saldo Kas
        </h3>

        <p class="text-muted mb-0">
            Ringkasan pemasukan, pengeluaran, dan saldo kas kelas saat ini.
        </p>

    </div>


    <!-- INFORMASI KEUANGAN -->
    <div class="row g-4">

        <!-- TOTAL PEMASUKAN -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        💰 Total Pemasukan
                    </p>

                    <h3 class="fw-bold text-success">
                        Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                    </h3>

                    <small class="text-muted">
                        Total pembayaran yang telah dikonfirmasi.
                    </small>

                </div>

            </div>

        </div>


        <!-- TOTAL PENGELUARAN -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        📉 Total Pengeluaran
                    </p>

                    <h3 class="fw-bold text-danger">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </h3>

                    <small class="text-muted">
                        Total seluruh pengeluaran kas kelas.
                    </small>

                </div>

            </div>

        </div>


        <!-- SALDO KAS -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        💵 Saldo Kas Saat Ini
                    </p>

                    <h3 class="fw-bold text-primary">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </h3>

                    <small class="text-muted">
                        Pemasukan dikurangi pengeluaran.
                    </small>

                </div>

            </div>

        </div>

    </div>


    <!-- INFORMASI PERHITUNGAN -->
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body">

            <h5 class="fw-bold">
                ℹ️ Informasi Saldo
            </h5>

            <p class="text-muted mb-0">
                Saldo kas dihitung dari total seluruh pembayaran yang sudah
                dikonfirmasi dikurangi dengan total seluruh pengeluaran kas.
            </p>

        </div>

    </div>


    <!-- TOMBOL KEMBALI -->
    <div class="mt-4">

        <a href="{{ route('dashboard') }}"
           class="btn btn-secondary">

            ← Kembali ke Dashboard

        </a>

    </div>

</div>

</body>
</html>