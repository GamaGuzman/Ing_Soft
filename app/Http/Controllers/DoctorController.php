<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Requests\UserRequest;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create(){
        return view('register.doctor');
    }

    public function store(DoctorRequest $request){

        //guardar en la BDD el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
            'phone' => $request->phone,
            'confirmed_password' => bcrypt($request->password_confirmation),
        ]);

        //Guardar en la BDD el doctor
        Doctor::create([
            'user_id' => $user->id,
            'field' => $request->field,
            'speciality' => $request->speciality,
            'age' => $request->age,
            'rfc' => $request->rfc,
            'office_address' => $request->office,
        ]);

        //Preparar los datos para guardarlos en los horario correspondientes
        $days= $request->days;
        $value=$request->schedule;
        $schedule_arr= explode(",",$value);
        $start_time= $schedule_arr[0];
        $end_time= $schedule_arr[1];
        $start_time = date("H:i:s", strtotime($start_time));
        $end_time = date("H:i:s", strtotime($end_time));

        $doctor_id= Doctor::where('user_id',$user->id)->first()->id;

        //Guardar en la BDD el horario del doctor
        foreach($days as $day){
            Schedule::create([
                'doctor_id' => $doctor_id,
                'day' => $day,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);
        }
        //Asignar el rol de doctor al usuario
        $user->assignRole('doctor');

        return redirect()->route('login');

    }
}
