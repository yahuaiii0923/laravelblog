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

    protected $fillable = ['title', 'slug', 'description', 'image_path', 'user_id'];

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
}
