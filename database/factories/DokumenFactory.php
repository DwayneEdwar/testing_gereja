<?php

namespace Database\Factories;

use App\Models\Dokumen;
use App\Models\AnggotaKeluarga;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumenFactory extends Factory
{
    protected $model = Dokumen::class;

    public function definition(): array
    {
        return [
            'anggota_keluarga_id' => AnggotaKeluarga::factory(),
            'jenis' => $this->faker->randomElement(['baptis', 'sidi']),
            'file' => 'dokumen/' . $this->faker->randomElement(['baptis', 'sidi']) . '/' . $this->faker->uuid() . '.pdf',
            'diunggah_oleh' => User::factory(),
        ];
    }

    public function baptis(): static
    {
        return $this->state(fn (array $attributes) => [
            'jenis' => 'baptis',
            'file' => 'dokumen/baptis/' . $this->faker->uuid() . '.pdf',
        ]);
    }

    public function sidi(): static
    {
        return $this->state(fn (array $attributes) => [
            'jenis' => 'sidi',
            'file' => 'dokumen/sidi/' . $this->faker->uuid() . '.pdf',
        ]);
    }
}