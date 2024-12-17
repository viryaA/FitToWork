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
            height: 513px;
            background-color: #f8f9fa;
        }
        .main-content {
            height: calc(100vh - 80px);
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <header class="header bg-transparent p-1 d-flex align-items-center">
            <div>
                <img src="logo_astratech.png" alt="ASTRAtech Logo" style="height: 50px; margin-right: 15px;">
            </div>
            <div class="text-black">
                <p><strong>ALFIA FAUZIAH (MAHASISWA)</strong><br><small>Login terakhir: 15 Desember 2024, 00:02 WIB</small></p>
            </div>
        </header>
        <div class="row flex-grow-1">
            <aside class="col-md-2 sidebar p-1">
                <ul>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>  Logout</a></li>
                    <li><a href="#"><i class="fas fa-home"></i>  Dashboard</a></li>
                    <li>
                    <a href="#" onclick="toggleDropdown(event)">
                        <i class="fas fa-caret-down"></i>  Kesehatan
                    </a>
                    <ul class="dropdown" style="display: none;"> <!-- Dropdown in Sidebar -->
                        <li><a href="#">Absensi Kesehatan</a></li>
                        <li><a href="#">Rekap Kehadiran</a></li>
                        <li><a href="#">Resume</a></li>
                    </ul>
                    </li>
                </ul>
            </aside>
            <main class="col-md-10 p-1 main-content">
                @yield('content')
            </main>
        </div>
    </div>
    <script>
    function toggleDropdown(event) {
    event.preventDefault(); // Prevent default link action
    const dropdown = event.target.nextElementSibling;

    if (dropdown && dropdown.classList.contains('dropdown')) {
      // Toggle the display of the dropdown menu
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none'; // Hide the menu
      } else {
        dropdown.style.display = 'block'; // Show the menu
      }
    }
  }
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
