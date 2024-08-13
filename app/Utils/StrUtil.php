<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

if(!function_exists('uploadFile')) {
    function uploadFile($file, $path) {
        $img_name = $file->hashName();
        return $file->move(public_path($path), $img_name) ? $path . '/' .$img_name : false;
    }
}

if(!function_exists('userWithMostLikes')) {
    function userWithMostLikes() {
        $res = DB::table('users')->selectRaw('users.*, count(comment_user_likes.user_id) as likes_counted')
        ->join('comments', 'users.id', '=', 'comments.user_id')
        ->join('comment_user_likes', 'comments.id', '=', 'comment_user_likes.comment_id')
        ->groupBy('users.id')
        ->orderBy('likes_counted', 'desc')->take(Config::get('constants.LIMIT_RECORD'))->get();
        return $res;
    }
}

