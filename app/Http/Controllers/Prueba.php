<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Prueba extends Controller
{

    public function create(Request $request)
    {
        //PRIMERO TOMAMOS EL ID DEL USUARIO QUE HA INICIADO SESIÓN
        $user_id= User::where('id', Auth::id())->first();
        $user_id = $user_id->id;

        //AHORA BUSCAMOS EN LA BASE DE DATOS EL USUARIO QUE TIENE ESE ID
        $user = User::where('id',$user_id)->first();

        $roles= $user->getRoleNames();
        $rol = $roles[0];




        return view('dashboard', compact('rol', 'user_id'));

    }
}
