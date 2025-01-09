@extends('layouts.role')

@section('title', 'K3')

@section('content')
<div class="breadcrumb">
      <span>Single Sign On Application</span> / <span>Dashboard</span>
    </div>

    <!-- Card -->
    <div class="card" id="fitToWorkCard">
      <h2>Fit to Work</h2>
      <div class="dropdown-content">
      <a href="{{ route('k3s.show', ['page' => 'beranda']) }}">Login sebagai <strong>K3</strong></a>
      </div>
    </div>
@endsection
