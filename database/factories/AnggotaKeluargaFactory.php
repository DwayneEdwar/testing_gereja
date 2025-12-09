<?php

namespace Database\Factories;

use App\Models\AnggotaKeluarga;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaKeluargaFactory extends Factory
{
    protected $model = AnggotaKeluarga::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
        ];
    }
}