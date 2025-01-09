<!-- resources/views/form.blade.php -->
@extends('layouts.upt')

@section('title', 'Rekap Absensi Kesehatan')
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
            background-color:rgb(255, 255, 255);
        }
    </style>
@endsection
@section('content')
    <div class="content mt-4">
        <div class="d-flex align-items-center">
            <span class="header">Fit to Work</span>
            <span class="mx-2">/</span>
            <span class="subheader">Kesehatan</span>
            <span class="mx-2">/</span>
            <span class="subheader">Rekap</span>
        </div>
        <div class="divider"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status Kesehatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
    <tr>
        <td>Selasa, 19 November 2024</td>
        <td><a href="#">Sehat</a></td>
        <td class="text-center">
            <!-- Ganti URL dengan lokasi file yang sesuai -->
            <a href="{{ asset('storage/surat_keterangan.pdf') }}">
                <i class="fas fa-eye"></i>
            </a>
        </td>
    </tr>
    <tr>
        <td>Selasa, 26 November 2024</td>
        <td><a href="#">Sakit</a></td>
        <td class="text-center">
            <!-- Ganti URL dengan lokasi file yang sesuai -->
            <a href="{{ asset('storage/surat_keterangan.pdf') }}">
                <i class="fas fa-eye"></i>
            </a>
        </td>
    </tr>
    <tr>
        <td>Kamis, 28 November 2024</td>
        <td><a href="#">Sehat</a></td>
        <td class="text-center">
            <!-- Ganti URL dengan lokasi file yang sesuai -->
            <a href="{{ asset('storage/surat_keterangan.pdf') }}">
                <i class="fas fa-eye"></i>
            </a>
        </td>
    </tr>
</tbody>
        </table>
    </div>
@endsection

