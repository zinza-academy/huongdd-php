<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentUserLike extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'comment_user_likes';
    protected $fillable = ['comment_id', 'user_id'];
}
