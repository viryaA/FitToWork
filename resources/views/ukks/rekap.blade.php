@extends('layouts.ukk')

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
            background-color: #f8f9fa;
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
            border-top: 1px solid #ddd;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
        }
        .text-center i {
            font-size: 1.2rem;
            color: #007bff;
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

        @if($responses->isEmpty())
            <div class="alert alert-warning text-center">
                Tidak ada data rekapan kesehatan tersedia.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Questionnaire ID</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responses as $response)
                        <tr>
                            <td>{{ $response->res_id }}</td>
                            <td>{{ $response->qur_id }}</td>
                            <td>
                                <a href="#">
                                    {{ $response->res_type === 'sehat' ? 'Sehat' : 'Sakit' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
