<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'author_id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
  
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function coverUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $coverUrl) => $coverUrl ? asset($coverUrl) : null
        );
    }
}
