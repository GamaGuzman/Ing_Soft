<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\UserRequest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PatientController extends Controller
{
    //


    public function create()
    {
        return view('register.patient');
    }

    public function store(UserRequest $request, PatientRequest $patientRequest)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
            'phone' => $request->phone,
            'confirmed_password' => bcrypt($request->password_confirmation),
        ]);

        Patient::create([
            'user_id' => $user->id,
            'age' => $patientRequest->age,
            ]
        );

        //Asignar rol de paciente
        $rolePatient= Role::where('name', 'patient')->first();
        $user->assignRole($rolePatient);

        return redirect()->route('login');
    }
}
