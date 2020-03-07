<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $perPage = 5;

    protected $fillable = [
        'title', 'content', 'user_id',
    ];

    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }

    public function getShortContentAttribute()
    {
        return Str::limit($this->content, 150, '...');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
