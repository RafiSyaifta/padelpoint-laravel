<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
        'payment_proof',
    ];

    // Jembatan ke tabel Lapangan
    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    // INI YANG ILANG: Jembatan ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
