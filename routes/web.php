<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return redirect()->route('login.form');
});
// Dashboard Route with parameter 'page'
Route::get('dashboards/{page}', [DashboardController::class, 'show'])->name('dashboards.show');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\KuisionerController;

Route::get('form/create', [KuisionerController::class, 'create'])->name('form.create');
Route::post('form/store', [KuisionerController::class, 'store'])->name('form.store');
