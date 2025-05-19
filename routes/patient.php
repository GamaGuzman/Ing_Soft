<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/registro/usuario',function(){
    return view('register.patient');
})->name('registro-paciente');

Route::post('/registro/usuario', [PatientController::class, 'store'])
    ->name('patient.store');


