<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Config;

class PostRepository {
    protected $postModel;

    public function __construct(Post $model) {
        $this->postModel = $model;
    }

    public function getAll($paginate = true) {
        $posts = $this->postModel::all();
        if ($paginate) {
            $posts = $this->postModel::withTrashed()->paginate(Config::get('constants.PER_PAGE'));
        }
        return $posts;
    }

    public function getPostById($id) {
        return $this->postModel::findOrFail($id);
    }

    public function create($data = []) {
        return $data ? $this->postModel::create($data) : false;
    }

    public function delete($field = 'id', $data) {
        return $this->postModel::whereIn($field, $data)->delete();
    }

    public function getNewestPost($limit) {
        return $this->postModel::orderBy('created_at', 'desc')->take($limit)->get();
    }

}
