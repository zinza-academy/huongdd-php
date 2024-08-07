<?php

namespace App\Services;

use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Schema;

class TagService {
    protected $tagRepository;

    public function __construct(TagRepository $repository) {
        $this->tagRepository = $repository;
    }

    public function delete($id) {
        $tag = $this->tagRepository->getTagById($id);
        return $tag->delete();
    }

    public function create(TagRequest $request) {
        $data = $request->validated();
        return $this->tagRepository->create($data);
    }

    public function update(TagRequest $request ,$id) {
        $tag = $this->tagRepository->getTagById($id);
        $data = $request->validated();
        return $tag->update($data);
    }

    public function deleteMany($field = '', $data = []) {
        $fieldMatch = Schema::getColumnListing('topics');
        if (!in_array($field, $fieldMatch)) {
            $field = 'id';
            $data = [];
        }
        return $this->tagRepository->delete($field, $data);
    }
}
