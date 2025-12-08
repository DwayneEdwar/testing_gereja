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

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    public function pelka()
    {
        return $this->belongsTo(Pelka::class, 'pelka_id');
    }

    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'anggota_keluarga_id', 'anggota_keluarga_id');
    }
}

