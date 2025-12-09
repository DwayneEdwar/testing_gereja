<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'anggota_keluarga_id',
        'file_baptis',
        'file_sidi',
        'diunggah_oleh',
    ];

    public function anggota()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'diunggah_oleh');
    }
    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

}
