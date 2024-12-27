@extends('layouts.role')

@section('title', 'Dashboard')

@section('content')
<div class="breadcrumb">
      <span>Single Sign On Application</span> / <span>Dashboard</span>
    </div>

    <!-- Card -->
    <div class="card" id="fitToWorkCard">
      <h2>Fit to Work</h2>
      <div class="dropdown-content">
      <a href="{{ route('dashboards.show', ['page' => 'beranda']) }}">Login sebagai <strong>Mahasiswa</strong></a>
      </div>
    </div>
@endsection
