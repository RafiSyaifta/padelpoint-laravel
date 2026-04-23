<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    
    protected $fillable = [
        'name',
        'price',
        'description',
        'type',
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_equipment')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }
}
