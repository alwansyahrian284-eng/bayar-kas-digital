<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Wali Kelas - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success">
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
        Selamat datang di Dashboard Wali Kelas
    </p>


    <!-- GRAFIK KAS MINGGUAN -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h5 class="fw-bold mb-1">
                📊 Grafik Kas per Minggu
            </h5>

            <p class="text-muted small mb-4">
                Informasi pemasukan, pengeluaran, dan saldo kas dalam 4 minggu terakhir.
            </p>

            <div style="height: 320px;">
                <canvas id="grafikKas"></canvas>
            </div>

        </div>

    </div>


    <!-- INFORMASI KAS -->
    <div class="row g-3">

        <!-- INFORMASI PEMASUKAN -->
        <div class="col-md-4">

            <a href="{{ route('walikelas.pemasukan') }}"
               class="text-decoration-none text-dark">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h5 class="fw-bold">
                            💰 Pemasukan Kas
                        </h5>

                        <p class="text-muted mb-0">
                            Melihat total pembayaran kas siswa yang telah dikonfirmasi.
                        </p>

                    </div>

                </div>

            </a>

        </div>


        <!-- INFORMASI PENGELUARAN -->
        <div class="col-md-4">

            <a href="{{ route('walikelas.pengeluaran') }}"
               class="text-decoration-none text-dark">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h5 class="fw-bold">
                            📉 Pengeluaran Kas
                        </h5>

                        <p class="text-muted mb-0">
                            Melihat informasi pengeluaran kas kelas.
                        </p>

                    </div>

                </div>

            </a>

        </div>


        <!-- INFORMASI SALDO -->
        <div class="col-md-4">

            <a href="{{ route('walikelas.saldo') }}"
               class="text-decoration-none text-dark">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h5 class="fw-bold">
                            💵 Saldo Kas
                        </h5>

                        <p class="text-muted mb-0">
                            Memantau saldo kas berdasarkan pemasukan dan pengeluaran.
                        </p>

                    </div>

                </div>

            </a>

        </div>

    </div>

</div>


<!-- SCRIPT GRAFIK -->
<script>
    const ctx = document.getElementById('grafikKas');

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

                    backgroundColor: 'rgba(13, 110, 253, 0.7)',

                    borderColor: 'rgba(13, 110, 253, 1)',

                    borderWidth: 1,

                    borderRadius: 5
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
                                new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            },

            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label +
                                ': Rp ' +
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