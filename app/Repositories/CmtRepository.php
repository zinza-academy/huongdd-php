<?php

namespace App\Repositories;

use App\Models\Comment;

class CmtRepository {
    protected $cmtModel;

    public function __construct(Comment $model)
    {
        $this->cmtModel = $model;
    }

    public function getCmtById($id) {
        return $this->cmtModel::findOrFail($id);
    }

    public function create($data) {
        return $this->cmtModel::create($data);
    }

    public function search($search) {
        return $this->cmtModel::where($search)->get();
    }
}
