<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nis',
        'email',
        'agama',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_ortu',
        'telepon_ortu',
        'foto',
        'jenis_kelamin',
        'rombel_id',
        'jurusan_id',
        'tahun_ajaran_id',
        'alamat',
        'user_id',
    ];

    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tingkat()
    {
        return $this->hasOneThrough(Tingkat::class, Rombel::class, 'id', 'tingkat', 'rombel_id', 'id');
    }
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeTidakAktif($query)
    {
        return $query->where('status', 'tidak aktif');
    }
}
