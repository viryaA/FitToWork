<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UkkController;
use App\Http\Controllers\K3Controller;
use App\Http\Controllers\GAController;
use App\Http\Controllers\DKAController;
use App\Http\Controllers\UPTController;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return redirect()->route('login.form');
});

// // Dashboard Route with parameter 'page'
Route::get('mahasiswas/{page}', [MahasiswaController::class, 'show'])->name('mahasiswas.show');

// Dashboard Route with parameter 'page'
Route::get('ukks/{page}', [UkkController::class, 'show'])->name('ukks.show');

// Route tambahan untuk UKK: pencarian data mahasiswa & karyawan
Route::get('/api/cari-mahasiswa/{nim}', [UkkController::class, 'cariMahasiswa'])->name('ukks.cariMahasiswa');
Route::get('/api/cari-karyawan/{npk}', [UkkController::class, 'cariKaryawan'])->name('ukks.cariKaryawan');
Route::post('/resume/store', [UkkController::class, 'store'])->name('resume.store');



// Dashboard Route with parameter 'page'
Route::get('k3s/{page}', [K3Controller::class, 'show'])->name('k3s.show');

// Dashboard Route with parameter 'page'
Route::get('gas/{page}', [GAController::class, 'show'])->name('gas.show');

// Dashboard Route with parameter 'page'
Route::get('dkas/{page}', [DKAController::class, 'show'])->name('dkas.show');

// Dashboard Route with parameter 'page'
Route::get('upts/{page}', [UPTController::class, 'show'])->name('upts.show');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\KuisionerController;

// Route::get('form/create', [KuisionerController::class, 'create'])->name('form.create');
// Route::post('form/store', [KuisionerController::class, 'store'])->name('form.store');
// Route::get('form/', [KuisionerController::class, 'index'])->name('form.index');
Route::resource('questionnaire', KuisionerController::class);
Route::put('questionnaire/{questionnaire}', [KuisionerController::class, 'update'])->name('questionnaire.update');
Route::get('questionnaire/show/{questionnaire}', [KuisionerController::class, 'show'])->name('questionnaire.show');


Route::post('/questionnaire/{id}/submit', [KuisionerController::class, 'submit'])->name('questionnaire.submit');
