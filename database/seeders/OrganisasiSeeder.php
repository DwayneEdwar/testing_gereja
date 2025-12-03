<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $list = ['Pemuda', 'Remaja', 'Kom Ibu', 'Kom Bapak', 'Lansia'];

    foreach ($list as $nama) {
        \App\Models\Organisasi::create(['nama' => $nama]);
    }
}

}
