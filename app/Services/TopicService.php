<?php

namespace App\Services;

use App\Http\Requests\TopicRequest;
use App\Repositories\TopicRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TopicService {
    protected $topicRepository;

    public function __construct(TopicRepository $repository) {
        $this->topicRepository = $repository;
    }

    public function delete($id) {
        $topic = $this->topicRepository->getTopicById($id);
        return $topic->delete();
    }

    public function create(TopicRequest $request) {
        $data = $request->validated();
        return $this->topicRepository->create($data);
    }

    public function update(TopicRequest $request ,$id) {
        $topic = $this->topicRepository->getTopicById($id);
        $data = $request->validated();
        return $topic->update($data);
    }

    public function deleteMany($field = '', $data = []) {
        $fieldMatch = Schema::getColumnListing('topics');
        if (!in_array($field, $fieldMatch)) {
            $field = 'id';
            $data = [];
        }
        return $this->topicRepository->delete($field, $data);
    }
}
