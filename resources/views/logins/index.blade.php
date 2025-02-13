<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Fit to Work</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100" style="font-family: Arial, sans-serif; background: url('{{ asset('layouts/background_login.jpg') }}') no-repeat center center fixed; background-size: cover;">
    
    <!-- Header -->
    <header class="bg-white py-3 px-4 shadow">
        <img src="{{ asset('layouts/logo_astratech.png') }}" alt="ASTRAtech Logo" style="max-height: 50px;">
    </header>

    <!-- Main Content -->
    <div class="container flex-grow-1 d-flex align-items-center justify-content-end">
        <div class="p-4 bg-white shadow rounded-3" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-3">Login Fit to Work</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Akun <span class="text-danger">*</span></label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle-fill"></i> Error!</strong>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <button type="submit" class="btn btn-success w-100">Masuk</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white py-3 text-center mt-auto shadow">
        <div class="fw-bold">Copyright © 2024 - MIS Politeknik Astra</div>
    </footer>
</body>
</html>
