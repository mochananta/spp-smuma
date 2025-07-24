<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'siswa_id',
        'kategori_pembayaran_id',
        'tahun_ajaran_id',
        'bulan',
        'tanggal_bayar',
        'kode',
        'nominal',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Pembayaran.php
    public function tahun_ajarans()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function kategoriPembayaran()
    {
        return $this->belongsTo(KategoriPembayaran::class, 'kategori_pembayaran_id');
    }
}
