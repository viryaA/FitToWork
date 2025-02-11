@extends('layouts.mahasiswa')

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
            background-color: rgb(255, 255, 255);
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
            border-top: 1px solid rgb(255, 255, 255);
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgb(255, 255, 255);
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
            <span class="subheader">Resume</span>
        </div>
        <div class="divider"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratKeterangan as $surat)
                <tr>
                    <td>{{ date('l, d F Y', strtotime($surat->skn_created_date)) }}</td>
                    <td><a href="#">{{ $surat->skn_status }}</a></td>
                    <td class="text-center">
                        <a href="{{ asset('storage/' . $surat->skn_berkas) }}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
