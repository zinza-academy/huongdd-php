<?php

namespace App\Services;

use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
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

    public function deleteMany($data) {
        $fieldMatch = Schema::getColumnListing('topics');
        return $this->tagRepository->delete($data);
    }

    public function getTag(Request $request) {
        $data = [];
        if ($search = $request->name) {
            $data = $this->tagRepository->search('name', $search);
        }
        return response()->json($data);
    }
}
