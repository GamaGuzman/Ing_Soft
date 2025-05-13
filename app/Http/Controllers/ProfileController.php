<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{

    public function edit(){

        //Obtenemos el id del usuario logueado
        $user_id = Auth::id();

        //Obtenemos el rol del usuario logueado
        $user_rol= User::where('id', $user_id)->first()
            ->getRoleNames()->first();

        return view('profile-info', compact( 'user_rol'));
    }

    public function updateInfo(Request $request){

        //Validamos los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        //Obtenemos el id del usuario logueado
        $user_id = Auth::id();

        //Actualizamos los datos del usuario
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePasswordPost(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->input('password')),
            'confirm_password' => Hash::make($request->input('password_confirmation')),
        ]);

        return redirect()->route('dashboard')->with('status', 'password-updated');
    }
}
