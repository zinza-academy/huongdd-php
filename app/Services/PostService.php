<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Jobs\SendMail;
use App\Mail\DelPostMailable;
use App\Repositories\PostRepository;
use App\Models\PostTag;
use Illuminate\Http\Request;

class PostService {
    protected $postRepository;

    public function __construct(PostRepository $repository) {
        $this->postRepository = $repository;
    }

    public function delete($id) {
        $post = $this->postRepository->getPostById($id);
        dispatch(new SendMail($post->user->email, new DelPostMailable($post)));
        return $post->delete();
    }

    public function create(PostRequest $request) {
        $data = $request->validated();
        $post = $this->postRepository->create($data);
        $post->tag()->sync($request->tags);
        return $post;
    }

    public function update(PostRequest $request ,$id) {
        $post = $this->postRepository->getPostById($id);
        $post->load('tag');
        $data = $request->validated();
        $post->tag()->sync($request->tags);
        return $post->update($data);
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $posts = [];
        if ($search) {
            $posts = $this->postRepository->search($search);
            $posts->appends(['search' => $search]);
        }
        return $posts;
    }

}
