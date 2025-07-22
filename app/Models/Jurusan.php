<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $fillable = ['jurusan'];

    public function rombels()
    {
        return $this->hasMany(Rombel::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
