<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Config;

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
        $users = $this->user::whereIn('id', $data)->get();
        foreach($users as $user) {
            $user->post()->delete();
            $user->comment()->delete();
            $user->delete();
        }
        return true;
    }


    public function search($field, $data) {
        return $this->user::where($field, $data)->paginate(Config::get('constants.PER_PAGE'));
    }
}
