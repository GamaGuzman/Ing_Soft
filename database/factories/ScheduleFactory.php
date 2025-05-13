<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes'];

        $startOptions = ['08:00:00','09:00:00','10:00:00','11:00:00','12:00:00','13:00:00','14:00:00','15:00:00'];
        $endOptions = ['17:00:00','18:00:00','19:00:00'];

        // Elegir una hora de inicio aleatoria
        $start = $this->faker->randomElement($startOptions);
        $startCarbon = \Carbon\Carbon::createFromFormat('H:i:s', $start);

        // Filtrar las horas de fin válidas (mayores que start)
        $endCandidates = collect($endOptions)->filter(function($hora) use ($startCarbon) {
            return \Carbon\Carbon::createFromFormat('H:i:s', $hora)->gt($startCarbon);
        })->values();

        // En caso de que no haya hora válida de fin, usar una por defecto o reintentar
        if ($endCandidates->isEmpty()) {
            $endCarbon = $startCarbon->copy()->addHours(2);
        } else {
            $end = $this->faker->randomElement($endCandidates->toArray());
            $endCarbon = \Carbon\Carbon::createFromFormat('H:i:s', $end);
        }

        return [
            'doctor_id' => $this->faker->numberBetween(1, 10),
            'day' => $this->faker->randomElement($dias),
            'start_time' => $startCarbon->format('H:i:s'),
            'end_time' => $endCarbon->format('H:i:s'),
        ];
    }
}
