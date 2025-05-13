<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

Route::get('/registro/doctor', [DoctorController::class, 'create'])->name('registro-doctor');
Route::post('/registro/doctor', [DoctorController::class, 'store'])->name('registro-doctor-store');
