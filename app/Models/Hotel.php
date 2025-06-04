<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{

    protected $fillable = [
        'name',
        'description',
        'city_id',   // только city_id, country_id не нужно
        'image',
        'rating',
        'price_per_night'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

// Если хочешь, можешь добавить связь через hasOneThrough (но не обязательно)
    public function country()
    {
        return $this->hasOneThrough(
            Country::class,
            City::class,
            'id',         // Foreign key on City table...
            'id',         // Foreign key on Country table...
            'city_id',    // Local key on Hotel table...
            'country_id'  // Local key on City table...
        );
    }

}
