<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <!-- Include Tailwind CSS -->
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .sidebar {
            background-color:rgb(255, 255, 255);
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
            width: 250px;
            padding-top: 20px;
            z-index: 1030; /* Ensure sidebar is on top */
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: #343a40;
        }
        .sidebar a:hover {
            background-color:rgb(255, 255, 255);
        }
        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 1rem;
            height: calc(100vh - 70px);
            overflow-y: auto;
            margin-top: 70px;
            margin-right: 50px;
        }
        .main-content::-webkit-scrollbar {
            display: none; /* Hide scrollbar for WebKit browsers */
        }
        .main-content {
            -ms-overflow-style: none;  /* Hide scrollbar for IE and Edge */
            scrollbar-width: none;  /* Hide scrollbar for Firefox */
        }
        @media (max-width: 768px) {
            .sidebar {
                left: -250px; /* Hide sidebar off-screen */
                transition: left 0.3s;
            }
            .sidebar.show {
                left: 0; /* Show sidebar */
            }
            .main-content {
                margin-left: 0; /* Adjust main content margin */
            }
        }
        @yield('style')
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <header class="bg-white p-2 d-flex align-items-center justify-content-between position-fixed w-100" style="z-index: 1030; top: 0; height: 70px;">
            <div class="flex-shrink-0">
                <img src="{{ asset('layouts/logo_astratech.png') }}" alt="ASTRAtech Logo" style="height: 50px; width: auto;">
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <div class="text-black text-end">
                    <p class="m-0">
                        <strong>{{ session('full_name') }} ({{ session('rol_id') }})</strong><br>
                        <small>{{ session('last_login_at') }}</small>
                    </p>
                </div>
                <div class="d-md-none">
                    <button class="btn btn-light" type="button" id="sidebarToggle" aria-label="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <span style="position: relative; margin-left: 10px; margin-right: 20px;">
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
            <nav class="col-md-2 sidebar p-1" id="sidebarMenu">
                <ul class="list-unstyled">
                    <!-- Logout Button -->
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-light btn-block mb-2 w-100" aria-label="Logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                    
                    <!-- Dashboard Link -->
                    <li>
                        <a href="{{ route('admin.show', ['beranda']) }}" 
                        class="btn btn-light btn-block mb-2 w-100 {{ Request::get('page') === 'beranda' ? 'active' : '' }}" aria-label="Dashboard">
                            <i class="fas fa-home" style="margin-right: 20px;"></i> Dashboard
                        </a>
                    </li>

                    <!-- Kesehatan Dropdown -->
                    <li>
                        <a href="#" 
                        class="btn btn-light btn-block mb-1 w-100 d-flex justify-content-between align-items-center" 
                        data-bs-toggle="collapse" data-bs-target="#healthDropdown" aria-expanded="false" aria-label="Kesehatan Dropdown">
                            <span><i class="fas fa-heartbeat" style="margin-right: 15px;"></i> Kesehatan</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul id="healthDropdown" class="list-unstyled collapse ps-3">
                            <li>
                                <a class="btn btn-light btn-block mb-2 w-100" href="http://127.0.0.1:8000/questionnaire/" aria-label="Kuisioner">
                                    Absensi Kesehatan
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

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>
    @yield('scripts')
</body>
</html>