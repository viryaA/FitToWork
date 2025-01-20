@extends('layouts.ga')

@section('title', 'Laporan Kesehatan Karyawan')

@section('style')
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }
        .table td {
            text-align: center;
        }
        .header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .divider {
            border-top: 1px solid #dee2e6;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
        }
        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .filter-container input {
            width: 300px;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .filter-container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .filter-container button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="content mt-4">
        <!-- Header navigasi -->
        <div class="d-flex align-items-center">
            <span class="header">Fit to Work</span>
            <span class="mx-2">/</span>
            <span class="subheader">Laporan</span>
            <span class="mx-2">/</span>
            <span class="subheader">Laporan Kesehatan Karyawan</span>
        </div>
        <div class="divider"></div>

        <!-- Filter dan pencarian -->
        <div class="filter-container">
            <input type="text" placeholder="Pencarian" aria-label="Pencarian">
            <button>Filter</button>
        </div>

        <!-- Tabel Data -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal Absensi</th>
                    <th>Nama</th>
                    <th>Bagian</th>
                    <th>Status Kesehatan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data statis langsung dituliskan -->
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Yuzmi Zakiya</td>
                    <td>Unit Kesehatan Kampus</td>
                    <td class="text-success">Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Tiara Ratna Suminar</td>
                    <td>DKA</td>
                    <td class="text-danger">Kurang Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Marchell Pangaribuan</td>
                    <td>DKA</td>
                    <td class="text-success">Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Afif Ar Rifai</td>
                    <td>DAAA</td>
                    <td class="text-success">Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Halyda Syafira</td>
                    <td>General Advisor</td>
                    <td class="text-success">Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Rizky Pangestu</td>
                    <td>General Advisor</td>
                    <td class="text-success">Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Sissy Caroline</td>
                    <td>Dosen</td>
                    <td class="text-success">Sehat</td>
                </tr>
                <tr>
                    <td>Senin, 18 November 2024</td>
                    <td>Muhammad Hammam</td>
                    <td>Dosen</td>
                    <td class="text-danger">Kurang Sehat</td>
                </tr>
            </tbody>
        </table>
        <!-- Pagination -->
        <!-- Pagination -->
        <div class="d-flex justify-content-start mt-3">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
