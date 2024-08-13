<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserRepository {
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAll($paginate = true) {
        $users = $this->user::all();
        if ($paginate) {
            $users = $this->user::paginate(Config::get('constants.PER_PAGE'));
        }
        return $users;
    }

    public function getUserById($id) {
        return $this->user::findOrFail($id);
    }

    public function create($data = []) {
        return $data ? $this->user::create($data) : false;
    }

    public function delete($data) {
        return $this->user::whereIn('id', $data)->delete();
    }


    public function search($field, $data) {
        return $this->user::where($field, $data)->paginate(Config::get('constants.PER_PAGE'));
    }

    public function getUsersWithMostLikes() {
        $res = DB::table('users')->selectRaw('users.*, count(comment_user_likes.user_id) as likes_counted')
        ->join('comments', 'users.id', '=', 'comments.user_id')
        ->join('comment_user_likes', 'comments.id', '=', 'comment_user_likes.comment_id')
        ->groupBy('users.id')
        ->orderBy('likes_counted', 'desc')->take(Config::get('constants.LIMIT_RECORD'))->get();
        return $res;
    }
}
