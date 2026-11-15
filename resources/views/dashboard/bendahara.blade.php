<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Bendahara - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <!-- Sambutan -->
    <h3 class="fw-bold">
        Halo, {{ auth()->user()->name }}! 👋
    </h3>

    <p class="text-muted mb-4">
        Selamat datang di Dashboard Bendahara
    </p>


    <!-- GRAFIK KEUANGAN MINGGUAN -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h5 class="fw-bold mb-1">
                📊 Grafik Keuangan Kas per Minggu
            </h5>

            <p class="text-muted small mb-4">
                Perbandingan pemasukan, pengeluaran, dan saldo kas selama 4 minggu terakhir.
            </p>

            <div style="height: 300px;">
                <canvas id="grafikPemasukan"></canvas>
            </div>

        </div>

    </div>


    <!-- Menu Dashboard -->
    <div class="row g-3">

        <!-- DATA SISWA -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        👨‍🎓 Data Siswa
                    </h5>

                    <p class="text-muted">
                        Tambahkan, lihat, dan edit akun siswa.
                    </p>

                    <a href="{{ route('siswa.index') }}"
                       class="btn btn-primary">
                        Kelola Siswa
                    </a>

                </div>

            </div>
        </div>


        <!-- PEMBAYARAN KAS -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        💰 Konfirmasi Pembayaran
                    </h5>

                    <p class="text-muted">
                        Lihat bukti pembayaran dan konfirmasi pembayaran kas siswa.
                    </p>

                    <a href="{{ route('bendahara.pembayaran.index') }}"
                       class="btn btn-success">
                        Kelola Pembayaran
                    </a>

                </div>

            </div>
        </div>


        <!-- PENGELUARAN KAS -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📉 Pengeluaran Kas
                    </h5>

                    <p class="text-muted">
                        Tambahkan, lihat, dan kelola data pengeluaran kas kelas.
                    </p>

                    <a href="{{ route('pengeluaran.index') }}"
                       class="btn btn-danger">
                        Kelola Pengeluaran
                    </a>

                </div>

            </div>
        </div>


        <!-- LAPORAN KAS -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📊 Laporan Kas
                    </h5>

                    <p class="text-muted">
                        Lihat total pemasukan, pengeluaran, dan saldo kas kelas.
                    </p>

                    <a href="{{ route('laporan.index') }}"
                       class="btn btn-info text-white">
                        Lihat Laporan
                    </a>

                </div>

            </div>
        </div>

    </div>

</div>


<!-- SCRIPT GRAFIK -->
<script>
    const ctx = document.getElementById('grafikPemasukan');

    new Chart(ctx, {
        type: 'bar',

        data: {
            labels: @json($labels),

            datasets: [

                {
                    label: 'Pemasukan',

                    data: @json($dataPemasukan),

                    backgroundColor: 'rgba(25, 135, 84, 0.7)',

                    borderColor: 'rgba(25, 135, 84, 1)',

                    borderWidth: 1,

                    borderRadius: 5
                },

                {
                    label: 'Pengeluaran',

                    data: @json($dataPengeluaran),

                    backgroundColor: 'rgba(220, 53, 69, 0.7)',

                    borderColor: 'rgba(220, 53, 69, 1)',

                    borderWidth: 1,

                    borderRadius: 5
                },

                {
                    label: 'Saldo',

                    data: @json($dataSaldo),

                    type: 'line',

                    borderColor: 'rgba(13, 110, 253, 1)',

                    backgroundColor: 'rgba(13, 110, 253, 0.1)',

                    borderWidth: 3,

                    tension: 0.3,

                    fill: false
                }

            ]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        callback: function(value) {
                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID')
                                    .format(value);
                        }
                    }
                }
            },

            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' +
                                new Intl.NumberFormat('id-ID')
                                    .format(context.raw);
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>