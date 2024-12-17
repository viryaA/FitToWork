<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ASTRA Tech Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: white;
      border-bottom: 2px solid #d1d1d1;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header img {
      height: 50px;
    }

    .header p {
      margin: 0;
      font-size: 1rem;
      color: #000;
    }

    .header p span {
      font-weight: bold;
    }

    .header-container {
      margin-left: 250px;
      display: flex;
      flex-direction: column;
      width: calc(100% - 250px); /* Adjusting the width for the sidebar */
    }

    .header {
      background-color: white;
      padding: 15px 20px;
      border-bottom: 1px solid #ddd;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .content {
      padding: 20px;
      background-color: white;
    }

    .alert {
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #ff9800;
      color: #333;
      font-weight: bold;
      border-radius: 5px;
    }

    .welcome-card {
    padding: 20px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: left; /* Mengubah penulisan teks menjadi rata kiri */
    }

    .tabs {
  border-bottom: 1px solid #ddd;
  padding: 10px;
}

.tab-list {
  list-style: none;
  display: flex;
  padding: 0;
  margin: 0;
}

.tab-item {
  padding: 10px 20px;
  border: 1px solid #ddd;
  border-bottom: none; /* Hilangkan garis bawah tab */
  border-radius: 5px 5px 0 0; /* Membuat sisi atas melengkung */
  background-color: white;
  margin-right: 5px;
}

.tab-item.active {
  font-weight: bold;
}

.tab-link {
  text-decoration: none;
  color: blue;
}

.tab-item:not(.active):hover {
  background-color: #f9f9f9;
  cursor: pointer;
}

.sidebar {
  width: 250px;
  background-color: white;
  color: black;
  height: 100vh;
  position: fixed;
  border-right: 1px solid #d1d1d1;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar ul li {
  padding: 15px 20px;
  border-bottom: 1px solid #d1d1d1;
}

.sidebar ul li a {
  text-decoration: none;
  color: black;
  display: flex;
  align-items: center;
}

.sidebar ul li:hover {
  background-color: #f1f1f1;
}

.dropdown {
  list-style-type: none;
  padding-left: 20px; /* Slight indentation for dropdown items */
  display: none; /* Initially hidden */
}

.dropdown li {
  padding: 10px 0;
  position: relative;
}

.dropdown li a {
  text-decoration: none;
  color: black;
  display: flex;
  align-items: center;
}

.dropdown li a::before {
  content: "—"; /* Menambahkan simbol garis minus */
  margin-right: 10px; /* Memberikan ruang antara garis dan teks */
  font-size: 1.5rem; /* Ukuran garis */
  color: #343a40; /* Warna garis */
}

.dropdown li:hover {
  background-color: #f1f1f1;
}


  </style>
</head>
<body>
  <div class="header">
    <div>
      <img src="logo_astratech.png" alt="ASTRAtech Logo">
    </div>
    <p style="display: flex; justify-content: space-between; align-items: center; margin: 0;">
  <span>
    <strong>ALFIA FAUZIAH (MAHASISWA)</strong><br>
    <small>Login terakhir: 15 Desember 2024, 00:02 WIB</small>
  </span>
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
</p>
  </div>

  <div class="sidebar">
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
</div>

  <div class="header-container">
    <div class="header">
    <strong><span style="color: blue;">Fit to Work</span> / Dashboard</strong>
    </div>
  <div class="content">
    <div class="alert alert-warning" style="color: white;">
        <i class="fas fa-exclamation-triangle" style="margin-right: 10px;"> <strong>SISTEM PENGINGAT</strong></i>
    </div>
    <div class="tabs">
      <ul class="tab-list">
        <li class="tab-item active">Beranda</li>
        <li class="tab-item"><a href="#" class="tab-link">Statistik Kesehatan</a></li>
      </ul>
    </div>
        <div class="welcome-card">
        <h3>Selamat Datang Civitas Akademika ASTRAtech!</h3>
        <p>
          Ini merupakan halaman beranda Fit to Work, silahkan untuk mengakses menu yang tersedia
          atau melihat informasi dashboard lainnya pada bilah tabulasi di atas.
        </p>
      </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
