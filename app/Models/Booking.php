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
        'racket_count',
        'ball_count',
        'water_count',
        'total_price',
        'status',
        'payment_proof',
        'snap_token'
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'booking_equipment')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }
}
