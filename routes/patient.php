<?php

use Illuminate\Support\Facades\Route;

Route::get('/registro/usuario',function(){
    return view('register.patient');
})->name('registro-paciente');

Route::post('/registro/usuario', [\App\Http\Controllers\PatientController::class, 'store'])
->name('patient.store');


