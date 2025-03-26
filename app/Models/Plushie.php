<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plushie extends Model
{
    protected $casts = [
        'traits' => 'array'
    ];

    public function getImageUrlAttribute()
    {
        if (empty($this->attributes['image_url'])) {
            return asset('storage/images/default-plushie.jpg');
        }

        return asset('storage/' . ltrim($this->attributes['image_url'], '/'));
    }
}
