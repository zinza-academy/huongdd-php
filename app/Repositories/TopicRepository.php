<?php

namespace App\Repositories;

use App\Models\Topic;
use Illuminate\Support\Facades\Config;

class TopicRepository {
    protected $topicModel;

    public function __construct(Topic $model)
    {
        $this->topicModel = $model;
    }

    public function getAll($paginate = true) {
        $topics = $this->topicModel::get();
        if ($paginate) {
            $topics = $this->topicModel::paginate(Config::get('constants.PER_PAGE'));
        }
        return $topics;
    }

    public function getTopicById($id) {
        return $this->topicModel::findOrFail($id);
    }

    public function create($data) {
        return $data ? $this->topicModel::create($data) : false;
    }

    public function delete($data) {
        return $this->topicModel::whereIn('id', $data)->delete();
    }

    public function getWithPost () {
        $topics = $this->topicModel->whereHas('post')->get();
        $topics->each(function ($topic) {
            $topic->post = $topic->post->take(Config::get('constants.LIMIT_POST'));
        });
        return $topics;
    }
}
