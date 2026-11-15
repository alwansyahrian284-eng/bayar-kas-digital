<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran Kas - Bayar Kas Digital</title>

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

    <!-- Pesan berhasil -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    <!-- ============================= -->
    <!-- HALAMAN UNTUK SISWA -->
    <!-- ============================= -->

    @if(auth()->user()->role === 'siswa')

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">
                    💰 Pembayaran Kas Saya
                </h3>

                <p class="text-muted mb-0">
                    Lihat riwayat dan status pembayaran kas Anda.
                </p>
            </div>

            <a href="{{ route('siswa.pembayaran.create') }}"
               class="btn btn-primary">
                + Bayar Kas
            </a>

        </div>


        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pembayarans as $pembayaran)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $pembayaran->keterangan ?? '-' }}
                                    </td>

                                    <td>

                                        @if($pembayaran->status === 'menunggu')

                                            <span class="badge bg-warning text-dark">
                                                Menunggu Konfirmasi
                                            </span>

                                        @elseif($pembayaran->status === 'dikonfirmasi')

                                            <span class="badge bg-success">
                                                Dikonfirmasi
                                            </span>

                                        @elseif($pembayaran->status === 'ditolak')

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($pembayaran->status) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5"
                                        class="text-center text-muted py-4">

                                        Belum ada riwayat pembayaran.

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    <!-- ============================= -->
    <!-- HALAMAN UNTUK BENDAHARA -->
    <!-- ============================= -->

    @elseif(auth()->user()->role === 'bendahara')

        <div class="mb-4">

            <h3 class="fw-bold mb-1">
                💰 Kelola Pembayaran Kas
            </h3>

            <p class="text-muted mb-0">
                Lihat, konfirmasi, tolak, atau hapus pembayaran kas siswa.
            </p>

        </div>


        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Bukti</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pembayarans as $pembayaran)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td class="fw-semibold">
                                        {{ $pembayaran->user->name ?? '-' }}
                                    </td>


                                    <td>
                                        {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}
                                    </td>


                                    <td>
                                        Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                                    </td>


                                    <td>

                                        @if($pembayaran->bukti_pembayaran)

                                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary">

                                                Lihat Bukti

                                            </a>

                                        @else

                                            <span class="text-muted">
                                                Tidak ada
                                            </span>

                                        @endif

                                    </td>


                                    <td>
                                        {{ $pembayaran->keterangan ?? '-' }}
                                    </td>


                                    <td>

                                        @if($pembayaran->status === 'menunggu')

                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>

                                        @elseif($pembayaran->status === 'dikonfirmasi')

                                            <span class="badge bg-success">
                                                Dikonfirmasi
                                            </span>

                                        @elseif($pembayaran->status === 'ditolak')

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($pembayaran->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <div class="d-flex gap-1 flex-wrap justify-content-center">

                                            <!-- KONFIRMASI -->
                                            @if($pembayaran->status === 'menunggu')

                                                <form method="POST"
                                                      action="{{ route('bendahara.pembayaran.konfirmasi', $pembayaran->id) }}">

                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit"
                                                            class="btn btn-success btn-sm">

                                                        Konfirmasi

                                                    </button>

                                                </form>


                                                <!-- TOLAK -->
                                                <form method="POST"
                                                      action="{{ route('bendahara.pembayaran.tolak', $pembayaran->id) }}">

                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit"
                                                            class="btn btn-warning btn-sm">

                                                        Tolak

                                                    </button>

                                                </form>

                                            @endif


                                            <!-- HAPUS -->
                                            <form method="POST"
                                                  action="{{ route('bendahara.pembayaran.destroy', $pembayaran->id) }}"
                                                  onsubmit="return confirm('Yakin ingin menghapus pembayaran ini? Data dan bukti pembayaran akan dihapus.')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8"
                                        class="text-center text-muted py-4">

                                        Belum ada pembayaran dari siswa.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>