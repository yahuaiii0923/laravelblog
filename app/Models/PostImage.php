<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'image_path'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getImagePathAttribute($value)
    {
        return $value;
    }

    public function setImagePathAttribute($value)
    {
        $this->attributes['image_path'] = Str::after($value, 'storage/');
    }
}
