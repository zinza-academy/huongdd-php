<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UploadRequest;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Repositories\TopicRepository;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    protected $postService, $postRepository, $topicRepository, $tagRepository;

    public function __construct(PostService $service, PostRepository $postRepository, TopicRepository $topicRepository, TagRepository $tagRepository){
        $this->postService = $service;
        $this->postRepository = $postRepository;
        $this->topicRepository = $topicRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();
        $posts->load('user');
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = $this->tagRepository->getAll(false);
        $topics = $this->topicRepository->getAll(false);
        return view('post.create', compact('tags', 'topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->postService->create($request);
        Session::flash('success', 'Post created');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->postRepository->getPostById($id);
        if (Gate::allows('update-post', $post)) {
            $post->load('tag');
            $topics = $this->topicRepository->getAll(false);
            $tags = $this->tagRepository->getAll(false);
            return view('post.update', compact('post', 'topics', 'tags'));
        }
        Session::flash('error', 'You dont have permission');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        $this->postService->update($request, $id);
        Session::flash('success', 'Post updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = $this->postRepository->getPostById($id);
        if (Gate::allows('delete-post', $post)) {
            $this->postService->delete($id);
            Session::flash('success', 'Post deleted!');
            return redirect()->back();
        }
        Session::flash('error', 'You have no permissions');
        return redirect()->back();
    }

    public function upload(UploadRequest $request) {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $url = asset(uploadFile($file, 'posts'));
            return response()->json(['uploaded' => 1, 'url' => $url]);
        }
    }
}
