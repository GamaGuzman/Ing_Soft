<?php

// app/Http/Controllers/AdminDoctorController.php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get();

        return view('index_admin', compact('doctors'));
    }

    public function toggleActive(Doctor $doctor)
    {
        $doctor->is_active = !$doctor->is_active;
        $doctor->save();

        return redirect()->back()->with('success', 'Estado del doctor actualizado.');
    }

    public function destroy(Doctor $doctor)
    {
        $user = $doctor->user;
        $doctor->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Doctor eliminado correctamente.');
    }
}
