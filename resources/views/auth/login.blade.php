<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Bayar Kas Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
        }

        .login-card {
            border: none;
            border-radius: 20px;
        }

        .login-icon {
            width: 65px;
            height: 65px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 15px;
        }

        @media (max-width: 576px) {
            .login-card {
                border-radius: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-11 col-sm-9 col-md-6 col-lg-4">

            <div class="card login-card shadow-lg">
                <div class="card-body p-4 p-md-5">

                    <div class="login-icon">
                        💰
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-1">Bayar Kas Digital</h3>
                        <p class="text-muted mb-0">
                            Silakan masuk ke akun Anda
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-lg"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control form-control-lg"
                                placeholder="Masukkan password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Masuk
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>