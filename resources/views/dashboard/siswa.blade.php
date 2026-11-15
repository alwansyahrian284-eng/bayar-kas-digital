<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Siswa - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">

        <span class="navbar-brand fw-bold">
            💰 Bayar Kas Digital
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-light btn-sm">
                Logout
            </button>
        </form>

    </div>
</nav>

<div class="container py-4">

    <h3 class="fw-bold">
        Halo, {{ auth()->user()->name }}! 👋
    </h3>

    <p class="text-muted mb-4">
        Selamat datang di Dashboard Siswa
    </p>

    <div class="row g-3">

        <!-- Pembayaran Kas -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    <h5 class="fw-bold">
                        💰 Pembayaran Kas
                    </h5>

                    <p class="text-muted">
                        Lakukan pembayaran kas melalui QR dan kirim bukti pembayaran.
                    </p>

                    <a href="{{ route('siswa.pembayaran.create') }}"
                       class="btn btn-primary">
                        Bayar Kas
                    </a>

                </div>
            </div>
        </div>

        <!-- Data Pembayaran -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    <h5 class="fw-bold">
                        📋 Data Pembayaran Kas
                    </h5>

                    <p class="text-muted">
                        Lihat riwayat pembayaran dan status konfirmasi dari Bendahara.
                    </p>

                    <a href="{{ route('siswa.pembayaran.index') }}"
                       class="btn btn-success">
                        Lihat Data Pembayaran
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>