<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('dashboards/{page}', [DashboardController::class, 'show'])->name('dashboards.show');



