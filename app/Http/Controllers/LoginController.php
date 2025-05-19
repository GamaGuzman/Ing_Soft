<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function create()
    {
        return view("login");
    }

public function store(LoginRequest $request)
{
    $request->authenticate();
    $request->session()->regenerate();


    $user = User::where('email', $request->email)->first();

    // Verifica si el usuario tiene rol "doctor" y está inactivo
    if ($user->hasRole('doctor')) {
        $doctor = Doctor::where('user_id', $user->id)->first();
        if ($doctor && !$doctor->is_active) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Tu cuenta de doctor aún no ha sido activada.');
        }
    }

    // Redirige según el rol
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.doctors.index');
    }
    else if ($user->hasRole('doctor') || $user->hasRole('patient')) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login')->with('error', 'Rol no reconocido.');
}


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
