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
    overflow: hidden; /* Mencegah scroll */
}

        .sidebar {
            background-color: rgb(255, 255, 255);
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
            width: 250px;
            padding-top: 20px;
            z-index: 1030;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: #343a40;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #007bff;
            color: white;
        }
        .main-content {
    margin-left: 250px;
    padding: 1rem;
    height: calc(100vh - 70px); /* Pastikan tinggi penuh tanpa scroll */
    overflow-y: auto; /* Hanya memungkinkan scroll jika diperlukan */
    margin-top: 70px;
}
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
                transition: left 0.3s;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
        @yield('style')
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Navbar -->
        <header class="bg-white p-2 d-flex align-items-center justify-content-between position-fixed w-100" style="z-index: 1030; top: 0; height: 70px;">
            <div>
                <img src="{{ asset('layouts/logo_astratech.png') }}" alt="ASTRAtech Logo" style="height: 50px;">
            </div>
            /* @php
    $user = auth()->user();
    $nama = $user?->mhs_nama ?? trim(($user?->kry_nama_depan ?? '') . ' ' . ($user?->kry_nama_blk ?? '')) ?: 'Pengguna';
    $role = $user?->rol_deskripsi ?? 'Tidak Diketahui';
    $lastLogin = $user?->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d F Y, H:i') : '-';
@endphp */

<p class="m-0">
    <strong>{{ session('full_name') }} ({{ session('rol_id') }})</strong><br>
    <small> Login terakhir: {{ session('last_login_at') }}</small>
</p>

        </header>

        <div class="row g-0">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar p-1" id="sidebarMenu">
                <ul class="list-unstyled">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light w-100 mb-2">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('ukks.show', 'beranda') }}" class="btn btn-light w-100 mb-2 {{ Request::is('ukks/beranda') ? 'active' : '' }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-light w-100 mb-1 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#healthDropdown" aria-expanded="false">
                            <span><i class="fas fa-heartbeat me-2"></i> Kesehatan</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul id="healthDropdown" class="list-unstyled collapse ps-3">
                            <li>
                                <a href="{{ route('ukks.show', 'absensi') }}" class="btn btn-light w-100 mb-2 {{ Request::is('ukks/absensi') ? 'active' : '' }}">
                                    Absensi Kesehatan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ukks.show', 'rekap') }}" class="btn btn-light w-100 mb-2 {{ Request::is('ukks/rekap') ? 'active' : '' }}">
                                    Rekap Kehadiran
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ukks.show', 'resume_mahasiswa') }}" class="btn btn-light w-100 mb-2 {{ Request::is('ukks/resume_mahasiswa') ? 'active' : '' }}">
                                    Mengirim Resume
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>
</body>
</html>
