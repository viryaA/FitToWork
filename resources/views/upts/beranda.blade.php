<!-- resources/views/form.blade.php -->
@extends('layouts.upt')

@section('title', 'Resume Absensi Kesehatan')
@section('style')
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color:rgb(255, 255, 255);
        } 
        .table td a {
            color: #007bff;
            text-decoration: none;
        }
        .table td a:hover {
            text-decoration: underline;
        }
        .header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .subheader {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
        }
        .divider {
            border-top: 1px solidrgb(255, 255, 255);
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f8f9fa;
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
    </style>
@endsection
@section('content')
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
@endsection

