<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMidtrans extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'status',
        'gross_amount',
        'payment_type',
        'fraud_status',
        'snap_token',
        'tagihan_ids',
    ];

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
