<?php

namespace Database\Factories;

use App\Models\Pelka;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelkaFactory extends Factory
{
    protected $model = Pelka::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->randomElement(['Pelka A', 'Pelka B', 'Pelka C', 'Pelka D']),
        ];
    }
}