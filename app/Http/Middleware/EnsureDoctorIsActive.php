<?php

namespace App\Http\Middleware;

use App\Models\Doctor;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureDoctorIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $user_name = Auth::user()->name;
    $user_rol = User::where('id', Auth::id())->first()
        ->getRoleNames()->first();
    $doctor_status = Doctor::where('user_id', Auth::id())->first();

    // Check if the user is a doctor and if their account is inactive
    if ($user_rol === 'doctor') {
        $doctor = User::where('name', $user_name)->first();
        if ($doctor && !$doctor_status?->is_active) {
            return redirect()->route('login')->with('error', 'Your account is inactive. Please contact support.');
        }
    }

    return $next($request);
}

}
