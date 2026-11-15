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
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <!-- Informasi Pembayaran -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">

                    <h4 class="fw-bold">
                        💰 Pembayaran Kas
                    </h4>

                    <p class="text-muted">
                        Silakan lakukan pembayaran melalui QR berikut.
                    </p>

                    <img src="{{ asset('images/qr-pembayaran.png') }}"
                         alt="QR Pembayaran"
                         class="img-fluid"
                         style="max-width: 280px;">

                    <p class="text-muted mt-3 mb-0">
                        Setelah melakukan pembayaran, isi data dan unggah bukti pembayaran di bawah.
                    </p>

                </div>
            </div>

            <!-- Form Pembayaran -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Kirim Bukti Pembayaran
                    </h4>

                    <form method="POST"
                          action="{{ route('siswa.pembayaran.store') }}"
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Nama otomatis dari akun -->
                        <div class="mb-3">
                            <label class="form-label">
                                Nama Siswa
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ auth()->user()->name }}"
                                   readonly>
                        </div>

                        <!-- Nominal -->
                        <div class="mb-3">
                            <label class="form-label">
                                Nominal Pembayaran
                            </label>

                            <input type="number"
                                   name="nominal"
                                   min="1000"
                                   class="form-control @error('nominal') is-invalid @enderror"
                                   value="{{ old('nominal') }}"
                                   placeholder="Contoh: 5000"
                                   required>

                            @error('nominal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label">
                                Tanggal Pembayaran
                            </label>

                            <input type="date"
                                   name="tanggal"
                                   class="form-control @error('tanggal') is-invalid @enderror"
                                   value="{{ old('tanggal', date('Y-m-d')) }}"
                                   required>

                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="mb-3">
                            <label class="form-label">
                                Upload Bukti Pembayaran
                            </label>

                            <input type="file"
                                   name="bukti_pembayaran"
                                   accept=".jpg,.jpeg,.png"
                                   class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                   required>

                            <div class="form-text">
                                Format: JPG, JPEG, atau PNG. Maksimal 2 MB.
                            </div>

                            @error('bukti_pembayaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <label class="form-label">
                                Keterangan (Opsional)
                            </label>

                            <input type="text"
                                   name="keterangan"
                                   class="form-control @error('keterangan') is-invalid @enderror"
                                   value="{{ old('keterangan') }}"
                                   placeholder="Contoh: Pembayaran kas minggu ke-1">

                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">

                            <a href="{{ route('siswa.pembayaran.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Kirim Pembayaran
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>