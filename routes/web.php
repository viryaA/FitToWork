<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

// Dashboard Route with parameter 'page'
Route::get('dashboards/{page}', [DashboardController::class, 'show'])->name('dashboards.show');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');