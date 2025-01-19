<!-- resources/views/form.blade.php -->
@extends('layouts.ga')

@section('title', 'Laporan Kecelakaan Karyawan')
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
            <span class="subheader">Laporan</span>
            <span class="mx-2">/</span>
            <span class="subheader">Laporan Karyawan</span>
        </div>
        <div class="divider"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Tanggal Absensi</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Bagian</th>
                    <th scope="col">Status Kesehatan</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

