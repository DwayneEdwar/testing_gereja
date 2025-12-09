<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchInfo extends Model
{
    protected $table = 'church_infos';

    protected $fillable = [
        'nama_gereja',
        'alamat',
        'gembala_jemaat',
        'kontak_gereja',
        'deskripsi',
    ];
}
