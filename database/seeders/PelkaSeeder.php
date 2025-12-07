<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $data = [
        'Pelka Bapak',
        'Pelka Ibu',
        'Pelka Pemuda',
        'Pelka Remaja',
        'Pelka Anak',
        'Pelka Lansia',
    ];

    foreach ($data as $p) {
        \App\Models\Pelka::create(['nama' => $p]);
    }
}

}
