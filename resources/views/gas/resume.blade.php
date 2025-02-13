@extends('layouts.ga')

@section('title', 'Resume Absensi Kesehatan')

@section('style')
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
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
            border-top: 1px solid #dee2e6;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
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

        @if ($suratKeterangan->isEmpty())
            <div class="alert alert-warning text-center">
                Belum ada data resume kesehatan.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratKeterangan as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->skn_created_date)->translatedFormat('l, d F Y') }}</td>
                            <td>
                            @if ($surat->skn_berkas && Storage::exists('public/resumes/' . $surat->skn_berkas))
                                <a href="{{ Storage::url('resumes/' . $surat->skn_berkas) }}" target="_blank" download>
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                            @else
                                <span class="text-muted">Tidak ada berkas</span>
                            @endif
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
