<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Posts extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'title',
        'body',
        'img_url',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function commentsCount()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->count();
    }
}
