<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    // Daftarin kolom yang boleh diisi secara massal
    protected $fillable = ['name', 'price_per_hour', 'image'];
}
