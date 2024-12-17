<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .sidebar {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .main-content {
            overflow-y: auto;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <header class="bg-transparent p-2 d-flex align-items-center justify-content-between">
            <!-- Logo on the left -->
            <div class="flex-shrink-0">
                <img src="{{ asset('layouts/logo_astratech.png') }}" alt="ASTRAtech Logo" style="height: 50px; width: auto;">
            </div>

            <!-- Content on the right (text and button) -->
            <div class="d-flex justify-content-end align-items-center">
                <div class="text-black text-end">
                    <p class="m-0">
                        <strong>ALFIA FAUZIAH (MAHASISWA)</strong><br>
                        <small>Login terakhir: 15 Desember 2024, 00:02 WIB</small>
                    </p>
                </div>
                <div class="d-md-none">
                    <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <span style="position: relative; margin-left: 10px;">
                    <i class="fas fa-envelope" style="font-size: 1.8rem; color: #343a40;"></i>
                    <span style="
                        position: absolute;
                        top: -5px;
                        right: -5px;
                        background-color: #007bff;
                        color: white;
                        font-size: 0.8rem;
                        font-weight: bold;
                        border-radius: 50%;
                        width: 20px;
                        height: 20px;
                        display: flex;
                        justify-content: center;
                        align-items: center;">
                        0
                    </span>
                </span>
            </div>
        </header>


        <div class="row g-0">
            <!-- Sidebar -->
            <nav class="col-md-2 collapse d-md-block sidebar p-1" id="sidebarMenu">
                <ul class="list-unstyled">
                    <li>
                        <a href="#" class="btn btn-light btn-block mb-2 w-100">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboards.show', ['page' => 'index']) }}" class="btn btn-light btn-block mb-2 w-100">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-light btn-block mb-2 w-100" data-bs-toggle="collapse" data-bs-target="#healthDropdown" aria-expanded="false">
                            <i class="fas fa-caret-down"></i> Kesehatan
                        </a>
                        <ul id="healthDropdown" class="list-unstyled collapse ps-3">
                            <li>
                                <a href="#" class="btn btn-light btn-block mb-1 w-100">Absensi Kesehatan</a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-light btn-block mb-1 w-100">Rekap Kehadiran</a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-light btn-block mb-1 w-100">Resume</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 col-sm-12 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
