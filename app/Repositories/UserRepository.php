<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAll($paginate = 10, $trashed = false) {
        return $trashed ? User::withTrashed()->paginate($paginate) : User::paginate($paginate);
    }

    public function getUserById($id) {
        return User::findOrFail($id);
    }

    public function create($data = []) {
        return $data ? User::create($data) : false;
    }
}
