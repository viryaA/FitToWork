<!-- resources/views/form.blade.php -->
@extends('layouts.ukk')

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
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .chart-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chart-box {
            width: 40%;
        }
        .table-box {
            width: 50%;
            padding-left: 20px;
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="card mb-4">
        <div class="card-header">Selamat Datang di Sistem Absensi Kesehatan Fit to Work</div>
        <div class="card-body">
            <p>Sistem Informasi ini akan membantu Anda dalam mengelola absensi kesehatan dengan lebih efisien. Mari mulai dengan mengeksplorasi fitur-fitur yang ada dengan mengakses menu yang tersedia.</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">Grafik Kesehatan</div>
        <div class="card-body">
            <div class="chart-container">
                <div class="chart-box">
                    <canvas id="healthChart"></canvas>
                </div>
                <div class="table-box">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Sehat</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>29 Januari 2025, 16:22</td>
                                <td>40</td>
                                <td>100</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('healthChart').getContext('2d');
    var healthChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Sehat', 'Tindakan'],
            datasets: [{
                data: [40, 100],
                backgroundColor: ['#007bff', '#ff3860']
            }]
        }
    });
</script>
@endsection