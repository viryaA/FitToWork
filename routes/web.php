<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UkkController;
use App\Http\Controllers\LoginController;

// // Dashboard Route with parameter 'page'
Route::get('mahasiswas/{page}', [MahasiswaController::class, 'show'])->name('mahasiswas.show');

// Dashboard Route with parameter 'page'
Route::get('ukks/{page}', [UkkController::class, 'show'])->name('ukks.show');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');