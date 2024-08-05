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
            $users = $this->user::paginate(Config::get('constant.PER_PAGE'));
        }
        return $users;
    }

    public function getUserById($id) {
        return $this->user::findOrFail($id);
    }

    public function create($data = []) {
        return $data ? $this->user::create($data) : false;
    }
}
