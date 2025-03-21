<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
      'title',
      'description',
      'slug',
      'content',
      'user_id',
    ];
    protected $dates = [
            'created_at',
            'updated_at'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()  // Corrected the method name from 'comment' to 'comments' for plural consistency
    {
        return $this->hasMany(Comment::class);  // Correct relationship definition
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    //to get the first image
    public function getFirstImageAttribute()
    {
        return $this->images->first();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
