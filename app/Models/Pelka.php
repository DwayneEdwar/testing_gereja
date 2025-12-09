<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelka extends Model
{
    protected $table = 'pelka';

    protected $fillable = ['nama'];

    public function anggota()
    {
        return $this->belongsToMany(AnggotaKeluarga::class, 'anggota_pelka', 'pelka_id', 'anggota_keluarga_id');
    }

    public function anggotaPelka()
    {
        return $this->hasMany(AnggotaPelka::class, 'pelka_id');
    }
}

