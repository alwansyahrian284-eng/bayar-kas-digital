<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Siswa - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">

        <a href="{{ route('siswa.index') }}"
           class="navbar-brand fw-bold text-decoration-none">
            💰 Bayar Kas Digital
        </a>

    </div>
</nav>

<div class="container py-4">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <h3 class="fw-bold mb-4">
                        Edit Data Siswa
                    </h3>

                    <form method="POST"
                          action="{{ route('siswa.update', $siswa->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Siswa
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $siswa->name) }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $siswa->email) }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr>

                        <p class="text-muted small">
                            Kosongkan password jika tidak ingin mengubah password siswa.
                        </p>

                        <div class="mb-3">
                            <label class="form-label">
                                Password Baru
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Konfirmasi Password Baru
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control">
                        </div>

                        <div class="d-flex gap-2">

                            <a href="{{ route('siswa.index') }}"
                               class="btn btn-secondary">
                                Batal
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Simpan Perubahan
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