<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'court_id', 'rating', 'comment'];

    // Relasi ke User (Siapa yang nulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Lapangan
    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
