<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug'];

    public function post() {
        return $this->hasMany(Post::class, 'topic_id');
    }

    public function latestPost() {
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function comment() {
        return $this->hasManyThrough(Comment::class, Post::class, 'topic_id', 'post_id');
    }
}
