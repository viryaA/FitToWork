@extends('layouts.role')

@section('title', 'upt')

@section('content')
<div class="breadcrumb">
      <span>Single Sign On Application</span> / <span>Dashboard</span>
    </div>

    <!-- Card -->
    <div class="card" id="fitToWorkCard">
      <h2>Fit to Work</h2>
      <div class="dropdown-content">
      <a href="{{ route('upts.show', ['page' => 'beranda']) }}">Login sebagai <strong>UPT</strong></a>
      </div>
    </div>
@endsection
