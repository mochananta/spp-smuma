<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajarans';

    protected $fillable = [
        'tahun_ajaran',
        'semester'
    ];

    public function rombels()
    {
        return $this->hasMany(Rombel::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
