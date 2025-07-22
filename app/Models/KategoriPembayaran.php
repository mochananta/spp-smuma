<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori',
        'nominal'
    ];

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'kategori_pembayaran_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'kategori_pembayaran_id');
    }
}
