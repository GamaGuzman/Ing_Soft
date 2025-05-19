<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon as Carbon;

class AppointmentController extends Controller
{
public function index()
{
    $user_name = Auth::user()->name;
    $user_rol = User::where('id', Auth::id())->first()
        ->getRoleNames()->first();

    if ($user_rol == 'patient') {
        $patient_id = Patient::where('user_id', Auth::id())->first()->id;
        $raw_appointments = Appointment::where('patient_id', $patient_id)
            ->orderByRaw('DAY(date), HOUR(date)')
            ->get();

        $appointments = $raw_appointments->isEmpty() ? [] : $raw_appointments->map(function ($raw_appointment) {
            return [
                'id' => $raw_appointment->id,
                'date' => Carbon::parse($raw_appointment->date)->format('d/m/Y'),
                'hour' => Carbon::parse($raw_appointment->date)->format('H:i'),
                'office' => $raw_appointment->office,
            ];
        });

    } elseif ($user_rol == 'doctor') {
        $doctor_id = Doctor::where('user_id', Auth::id())->first()->id;
        $raw_appointments = Appointment::where('doctor_id', $doctor_id)
            ->orderByRaw('DAY(date), HOUR(date)')
            ->get();

        $appointments = $raw_appointments->isEmpty() ? [] : $raw_appointments->map(function ($raw_appointment) {
            return [
                'id' => $raw_appointment->id,
                'date' => Carbon::parse($raw_appointment->date)->format('d/m/Y'),
                'hour' => Carbon::parse($raw_appointment->date)->format('H:i'),
                'office' => $raw_appointment->office,
            ];
        });

    } else {
        // Si el rol no es ni patient ni doctor, redirigir o mostrar algo neutral
        return redirect()->route('login')->with('error', 'Rol no autorizado para ver el dashboard.');
    }

    return view('dashboard', compact('user_name', 'user_rol', 'appointments'));
}


    public function create(Request $request)
    {
        $specialities = Doctor::distinct()->pluck('speciality');
        $selectedSpeciality = $request->input('speciality');
        $selectedOffice = $request->input('office_address');
        $selectedDoctor = $request->input('doctor');

        $doctors_offices = [];
        $doctors = [];
        $days = [];
        $dayTimeMap = [];

        // Paso 1: Especialidad
        if ($specialities->count() === 1 && !$selectedSpeciality) {
            $selectedSpeciality = $specialities[0];
        }

        if ($selectedSpeciality) {
            $doctorRecords = Doctor::where('speciality', $selectedSpeciality)
            ->where('is_active',true)->get();
            $doctors_offices = $doctorRecords->pluck('office_address')->unique();

            if ($doctors_offices->count() === 1 && !$selectedOffice) {
                $selectedOffice = $doctors_offices->first();
            }
        }

        // Paso 2: Clínica
        if ($selectedOffice) {
            $doctorRecords = Doctor::where('speciality', $selectedSpeciality)
                ->where('office_address', $selectedOffice)
                ->get();

            $doctorUserIds = $doctorRecords->pluck('user_id');
            $doctors = User::whereIn('id', $doctorUserIds)->get();

            if ($doctors->count() === 1 && !$selectedDoctor) {
                $selectedDoctor = $doctors[0]->id;
            }
        }

        // Paso 3: Doctor
        if ($selectedDoctor) {
            $doctorId = Doctor::where('user_id', $selectedDoctor)->first()->id;

            $schedules = Schedule::where('doctor_id', $doctorId)->get();
            $dayMap = ['sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6];

            foreach ($schedules as $schedule) {
                $dayNum = $dayMap[$schedule->day] ?? null;
                if ($dayNum !== null) {
                    $days[] = $dayNum;
                    $dayTimeMap[$dayNum] = $schedule->start_time;
                }
            }
            sort($days);
        }

        return view('appointments.create', compact(
            'specialities',
            'selectedSpeciality',
            'doctors',
            'doctors_offices',
            'selectedOffice',
            'selectedDoctor',
            'days',
            'dayTimeMap'
        ));
    }

    public function store(Request $request)
    {
        // Verifica que llegan los datos
        logger('Formulario recibido:', $request->all());

        $request->validate([
            'appointment_datetime' => 'required|date|after_or_equal:now',
            'doctor_id' => 'required|exists:doctors,user_id',
        ]);

        // Buscar paciente
        $patient = Patient::where('user_id', Auth::id())->first();
        if (!$patient) {
            logger('Paciente no encontrado para user_id: ' . Auth::id());
            return redirect()->back()->withErrors('Paciente no encontrado.');
        }

        // Buscar doctor
        $doctor = Doctor::where('user_id', $request->doctor_id)->first();
        if (!$doctor) {
            logger('Doctor no encontrado para user_id: ' . $request->doctor_id);
            return redirect()->back()->withErrors('Doctor no encontrado.');
        }

        // Verifica los datos antes de guardar
        logger('Datos a guardar:', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'date' => $request->appointment_datetime,
            'office' => $doctor->office_address,
        ]);

        // Intenta guardar
        $existingAppointment = Appointment::where('doctor_id', $doctor->id)
            ->where('date', $request->appointment_datetime)
            ->first();

        if ($existingAppointment) {
            return redirect()->back()->withErrors('Ya existe una cita para ese doctor en la fecha y hora seleccionadas.');
        }

        // Si no existe, crea la nueva cita
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'date' => $request->appointment_datetime,
            'office' => $doctor->office_address,
        ]);

        logger('Cita creada:', $appointment->toArray());

        return redirect()->route('appointments.create')->with('success', 'Cita reservada correctamente.');
    }

    public function show($id)
    {
        $appointmentRaw = Appointment::findOrFail($id);
        $doctor_id = Doctor::where('id', $appointmentRaw->doctor_id)
        ->first()->user_id;
        $patient_id = Patient::where('id', $appointmentRaw->patient_id)
        ->first()->user_id;

        $appointment = [
            'id' => $appointmentRaw->id,
            'date' => Carbon::parse($appointmentRaw->date)->format('d/m/Y'),
            'hour' => Carbon::parse($appointmentRaw->date)->format('H:i'),
            'office' => $appointmentRaw->office,
            'doctor' => User::where('id', $doctor_id)->first()->name,
            'patient' => User::where('id', $patient_id)->first()->name,
        ];
        return view('appointments.show', compact('appointment', 'appointmentRaw'));
    }

    public function edit(Appointment $appointment)
    {
        $doctor = Doctor::findOrFail($appointment->doctor_id);

        $schedules = Schedule::where('doctor_id', $doctor->id)->get(); // corregido

        $dayMap = [
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6
        ];

        $days = [];
        $dayTimeMap = [];
        $dayMaxTimeMap = [];

        foreach ($schedules as $schedule) {
            $dayNum = $dayMap[$schedule->day] ?? null;
            if ($dayNum !== null) {
                $days[] = $dayNum;
                $dayTimeMap[$dayNum] = $schedule->start_time;
                $dayMaxTimeMap[$dayNum] = $schedule->end_time;
            }
        }

        return view('appointments.edit', compact('appointment', 'days', 'dayTimeMap', 'dayMaxTimeMap'));
    }


    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'appointment_datetime' => 'required|date|after_or_equal:now',
        ]);

        $appointment->update([
            'date' => $request->appointment_datetime,
        ]);

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'La cita fue actualizada correctamente.');
    }


    public function destroy($id)
    {
        Appointment::destroy($id);

        return redirect()->route('dashboard');
    }
}
