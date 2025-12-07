<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    protected $table = 'kk';

    protected $fillable = [
        'nomor_kk',
        'name_kk',
        'kelompok_id',
        'alamat',
    ];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'kk_id');
    }
}
