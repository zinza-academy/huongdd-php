<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use App\Models\PostTag;

class PostService {
    protected $postRepository;

    public function __construct(PostRepository $repository) {
        $this->postRepository = $repository;
    }

    public function delete($id) {
        $tag = $this->postRepository->getTagById($id);
        return $tag->delete();
    }

    public function create(PostRequest $request) {
        $data = $request->validated();
        $post = $this->postRepository->create($data);
        foreach($request->tags as $tag) {
            PostTag::create([
                'post_id' => $post->id,
                'tag_id' => $tag
            ]);
        }
        return $post;
    }

    public function update(PostRequest $request ,$id) {
        $tag = $this->postRepository->getTagById($id);
        $data = $request->validated();
        return $tag->update($data);
    }

}
