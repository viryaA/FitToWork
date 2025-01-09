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
                <div class="text-black text-end" style="position: relative; margin-left: 10px; margin-right: 20px;">
                    <p class="m-0">
                    Hai, <span><strong>{{ auth()->user()->name ?? 'Guest' }}</strong></span>
                    </p>
                </div>
                <div class="d-md-none" >
                    <button class="btn btn-light" type="button" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="row g-0">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar" id="sidebarMenu">
              <ul class="list-unstyled">
                <li><a href="#"><i class="fas fa-key me-2"></i> Ubah Kata Sandi</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-light btn-block mb-2 w-100">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
              </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>
</body>
</html>