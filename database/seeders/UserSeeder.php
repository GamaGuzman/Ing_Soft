<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Permission::create(["name" => "crear cita"]);
        Permission::create(["name" => "ver cita"]);
        Permission::create(["name" => "editar cita"]);
        Permission::create(["name" => "eliminar cita"]);

        $patientUser = User::create([
            'name' => 'patient',
            'email' => 'paciente@gmail.com',
            'password' => bcrypt('12345678'),
            'confirmed_password' => bcrypt('12345678'),
            'phone' => '123456789',
            'email_verified_at' => now(),
        ]);

        $rolePatient = Role::create(["name" => "patient"]);
        $patientUser->assignRole($rolePatient);
        //Aqui le estas dando todos los permisos al rol de paciente, tienes que cambiar eso despues
        $rolePatient->syncPermissions('crear cita','ver cita','editar cita','eliminar cita');

        $doctorUser= User::create([
            'name' => 'doctor',
            'email'=> 'doctor@gmail.com',
            'password' => bcrypt('12345678'),
            'confirmed_password' => bcrypt('12345678'),
            'phone' => '123456789',
            'email_verified_at' => now(),
        ]);

        $roleDoctor = Role::create(["name" => "doctor"]);
        $doctorUser->assignRole($roleDoctor);
        $roleDoctor->syncPermissions(['ver cita','editar cita']);

    }
}
