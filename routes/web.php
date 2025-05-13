<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Prueba;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('inicio');

});

Route::get('/login', [LoginController::class, 'create'])->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/registro', function () {
    return view('register.choice');})->name('registro');



Route::get('/inicio', [AppointmentController::class, 'index'])->name('dashboard');

Route::get('/crear-cita', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/guardar-cita', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/mostrar-cita/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::delete('/borrar-cita/{id}',[AppointmentController::class, 'destroy'])->name('appointments.destroy');
// Mostrar el formulario de edición
Route::get('/editar-cita/{appointment}', [AppointmentController::class, 'edit'])->name('appointments.edit');

// Guardar los cambios de la cita
Route::put('/actualizar-cita/{appointment}', [AppointmentController::class, 'update'])
    ->name('appointments.update');

Route::get('info-usuario',[ProfileController::class, 'edit'])->name('profile.edit');
Route::put('info-usuario/update',[ProfileController::class, 'updateInfo'])->name('profile.update');
Route::put('info-usuario/update-password',[ProfileController::class, 'updatePassword'])->name('profile.password');

require __DIR__.'/patient.php';
require __DIR__.'/doctor.php';























 Route::get('/prueba', [Prueba::class, 'create']);

Route::post('/prueba/store', [Prueba::class, 'store'])->name('prueba.store');

