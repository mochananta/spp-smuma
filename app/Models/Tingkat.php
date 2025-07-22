<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;
    protected $table = 'tingkats';

    protected $fillable = ['tingkat'];

    public function rombels()
    {
        return $this->hasMany(Rombel::class);
    }
}
