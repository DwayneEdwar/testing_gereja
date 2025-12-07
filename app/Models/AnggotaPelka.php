<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaPelka extends Model
{
    protected $table = 'anggota_pelka';

    protected $fillable = [
        'kelompok_id',
        'pelka_id',
        'anggota_keluarga_id',
    ];
}

