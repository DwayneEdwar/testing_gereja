<?php

namespace Database\Factories;

use App\Models\AnggotaPelka;
use App\Models\Kelompok;
use App\Models\Pelka;
use App\Models\AnggotaKeluarga;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaPelkaFactory extends Factory
{
    protected $model = AnggotaPelka::class;

    public function definition(): array
    {
        return [
            'kelompok_id' => Kelompok::factory(),
            'pelka_id' => Pelka::factory(),
            'anggota_keluarga_id' => AnggotaKeluarga::factory(),
        ];
    }
}