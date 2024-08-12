<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'description', 'user_id', 'topic_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tag() {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
