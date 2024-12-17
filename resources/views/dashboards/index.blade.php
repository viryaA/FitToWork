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

    .sidebar ul li a i {
      margin-right: 10px;
    }

    .sidebar ul li:hover {
      background-color: #f1f1f1;
    }

    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    .breadcrumb {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 20px;
    }

    .breadcrumb span {
      color: #007bff;
    }

    .breadcrumb span:last-child {
      color: black;
    }

    .card {
      background-color: #f1f1f1;
      border: 1px solid #d1d1d1;
      border-radius: 5px;
      padding: 15px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      position: relative;
    }

    .card h2 {
      font-size: 1.2rem;
      color: #007bff;
      margin: 0;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: white;
      border: 1px solid #d1d1d1;
      width: 100%;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .dropdown-content a {
      display: block;
      padding: 10px 15px;
      text-decoration: none;
      color: black;
      font-size: 0.9rem;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .card.open .dropdown-content {
      display: block;
    }
  </style>
</head>
<body>
  <div class="header">
    <div>
      <img src="logo_astratech.png" alt="ASTRAtech Logo">
    </div>
    <p>Hai, <span>Alfia Fauziah</span></p>
  </div>

  <div class="sidebar">
    <ul>
      <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="#"><i class="fas fa-key"></i> Ubah Kata Sandi</a></li>
    </ul>
  </div>

  <div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
      <span>Single Sign On Application</span> / <span>Dashboard</span>
    </div>

    <!-- Card -->
    <div class="card" id="fitToWorkCard">
      <h2>Fit to Work</h2>
      <div class="dropdown-content">
      <a href="#">Login sebagai <strong>Mahasiswa</strong></a>
      </div>
    </div>
  </div>

  <script>
    // JavaScript untuk mengelola dropdown
    document.getElementById('fitToWorkCard').addEventListener('click', function () {
      this.classList.toggle('open');
    });
  </script>
</body>
</html>
