<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Appointment;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
    $doctorIds = User::doctors()->pluck('id');
	$patientIds = User::patients()->pluck('id');

	$date = fake()->dateTimeBetween('-1 years', 'now');
	$scheduled_date = $date->format('Y-m-d');
	$scheduled_time = $date->format('H:i:s');

	$types = ['Consulta', 'Examen', 'Operación'];
	$statuses = ['Atendida', 'Cancelada']; // 'Reservada', 'Confirmada'

        return [
        'description' => fake()->sentence(5),
        'specialty_id' => fake()->numberBetween(1, 3),
        'doctor_id' => fake()->randomElement($doctorIds),
        'patient_id' => fake()->randomElement($patientIds),
        'scheduled_date' => $scheduled_date,
        'scheduled_time' => $scheduled_time,
        'type' => fake()->randomElement($types),
        'status' => fake()->randomElement($statuses)
        ];
    }
}
