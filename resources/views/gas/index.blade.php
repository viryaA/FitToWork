@extends('layouts.role')

@section('title', 'ga')

@section('content')
<div class="breadcrumb">
      <span>Single Sign On Application</span> / <span>Dashboard</span>
    </div>

    <!-- Card -->
    <div class="card" id="fitToWorkCard">
      <h2>Fit to Work</h2>
      <div class="dropdown-content">
      <a href="{{ route('gas.show', ['page' => 'beranda']) }}">Login sebagai <strong>GA</strong></a>
      </div>
    </div>
@endsection
