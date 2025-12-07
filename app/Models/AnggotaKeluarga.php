<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    protected $table = 'anggota_keluarga';

    protected $fillable = [
        'kk_id',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'status_dalam_keluarga',
        'sudah_baptis',
        'sudah_sidi',
    ];

    public function kk()
    {
        return $this->belongsTo(KK::class, 'kk_id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'anggota_keluarga_id');
    }

    public function pelka()
    {
        return $this->belongsToMany(Pelka::class, 'anggota_pelka', 'anggota_keluarga_id', 'pelka_id');
    }
}

