<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lecturer>
 */
class LecturerFactory extends Factory
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
                'position' => $this->faker->jobTitle(), 
                 'materi' => $this->faker->url(), 
                'jadwal' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),  
               
            

            
        ];
    }
}
