<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id'=> User::factory(),
                'field' => $this->faker->word(),
                'speciality' => $this->faker->randomElement([
                    'cirugía general',
                    'Medicina Interna',
                    'Ginecología y Obstetricia',
                    'Pediatría'
                ]),
                'office_address'=> $this->faker->randomElement([
                    '14 Sur',
                    'Tlaxcala',
                    '18 Norte',
                    'Puebla',
                    'Calle 5 de Febrero',
                ]),
                'age' => $this->faker->numberBetween(25,75),
                'RFC'=> $this->faker->unique()->regexify('[A-Z]{4}[0-9]{6}[A-Z0-9]{3}'),
        ];
    }
}
