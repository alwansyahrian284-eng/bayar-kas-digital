<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pengeluaran - Bayar Kas Digital</title>

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

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <h3 class="fw-bold mb-1">
                        📉 Tambah Pengeluaran Kas
                    </h3>

                    <p class="text-muted mb-4">
                        Masukkan data pengeluaran kas kelas.
                    </p>


                    <form method="POST"
                          action="{{ route('pengeluaran.store') }}">

                        @csrf


                        <!-- Nama Pengeluaran -->
                        <div class="mb-3">

                            <label class="form-label">
                                Nama Pengeluaran
                            </label>

                            <input type="text"
                                   name="nama_pengeluaran"
                                   class="form-control @error('nama_pengeluaran') is-invalid @enderror"
                                   value="{{ old('nama_pengeluaran') }}"
                                   placeholder="Contoh: Membeli perlengkapan kelas"
                                   required>

                            @error('nama_pengeluaran')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- Nominal -->
                        <div class="mb-3">

                            <label class="form-label">
                                Nominal Pengeluaran
                            </label>

                            <input type="number"
                                   name="nominal"
                                   min="1"
                                   class="form-control @error('nominal') is-invalid @enderror"
                                   value="{{ old('nominal') }}"
                                   placeholder="Contoh: 50000"
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
                                Tanggal Pengeluaran
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


                        <!-- Keterangan -->
                        <div class="mb-4">

                            <label class="form-label">
                                Keterangan <span class="text-muted">(Opsional)</span>
                            </label>

                            <textarea name="keterangan"
                                      rows="3"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      placeholder="Tambahkan keterangan jika diperlukan">{{ old('keterangan') }}</textarea>

                            @error('keterangan')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- Tombol -->
                        <div class="d-flex gap-2">

                            <a href="{{ route('pengeluaran.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Simpan Pengeluaran
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