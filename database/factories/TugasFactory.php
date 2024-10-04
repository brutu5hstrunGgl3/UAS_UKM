<?php

namespace Database\Factories;

use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;

class TugasFactory extends Factory
{
    protected $model = Tugas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'learning' => $this->faker->word(),  // Menghasilkan kata acak untuk kolom learning
            'lecturer' => $this->faker->name(),  // Menghasilkan nama acak untuk kolom lecturer
            'file' => $this->faker->fileExtension(), // Menghasilkan ekstensi file acak (.pdf, .docx, dll.)
            'created_at' => now(), // Tanggal saat ini
            'updated_at' => now(), // Tanggal saat ini
        ];
    }
}
