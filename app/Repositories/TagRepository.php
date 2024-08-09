<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Facades\Config;

class TagRepository {
    protected $tagModel;

    public function __construct(Tag $model)
    {
        $this->tagModel = $model;
    }

    public function getAll($paginate = true) {
        $topics = $this->tagModel::all();
        if ($paginate) {
            $topics = $this->tagModel::paginate(Config::get('constant.PER_PAGE'));
        }
        return $topics;
    }

    public function getTagById($id) {
        return $this->tagModel::findOrFail($id);
    }

    public function create($data) {
        return $data ? $this->tagModel::create($data) : false;
    }

    public function delete( $data) {
        return $this->tagModel::whereIn('id', $data)->delete();
    }

}
