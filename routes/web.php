<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboards.absensi');
});

use App\Http\Controllers\AuthController;



