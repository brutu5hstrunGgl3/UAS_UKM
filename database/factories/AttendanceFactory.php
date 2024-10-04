<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'materi' => $this->faker->word(),
            'pemateri' => $this->faker->word(),
            'jadwal' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
            'status' => $this->faker->randomElement(['hadir', 'tidak hadir']),
            
        ];
    }
}
