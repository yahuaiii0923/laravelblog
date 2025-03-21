<?php

use Illuminate\Support\Str;
use App\Models\Post;

Class PostImage extends Model
{
    protected $fillable = ['image_path'];

    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getImagePathAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setImagePathAttribute($value)
    {
        $this->attributes['image_path'] = Str::after($value, 'storage/');
    }
}

