@extends('layouts.admin')

@section('title', 'Resume Absensi Kesehatan')

@section('content')
<div class="p-6">
    <!-- Alert -->
    <div class="bg-orange-500 text-white font-bold p-4 rounded flex items-center justify-between">
        <i class="fas fa-exclamation-triangle mr-2"></i> 
        <span>SISTEM PENGINGAT</span>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-300 py-2 mt-4">
        <ul class="flex space-x-4">
            <li class="font-bold text-blue-600">Beranda</li>
            <li><a href="#" class="text-gray-700 hover:text-blue-500">Statistik Kesehatan</a></li>
        </ul>
    </div>

    <!-- Welcome Card -->
    <div class="mt-6 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-bold text-gray-900">Selamat Datang Civitas Akademika ASTRAtech!</h3>
        <p class="mt-2 text-gray-600">
            Ini merupakan halaman beranda Fit to Work, silahkan untuk mengakses menu yang tersedia
            atau melihat informasi dashboard lainnya pada bilah tabulasi di atas.
        </p>
    </div>
</div>
@endsection
