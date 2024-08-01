<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAll($paginate = 10, $trashed = false) {
        return $trashed ? $this->user::withTrashed()->paginate($paginate) : $this->user::paginate($paginate);
    }

    public function getUserById($id) {
        return $this->user::findOrFail($id);
    }

    public function create($data = []) {
        return $data ? $this->user::create($data) : false;
    }
}
