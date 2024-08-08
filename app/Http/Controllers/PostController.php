<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Repositories\TopicRepository;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $tags = $this->tagRepository->getAll(false);
        $topics = $this->topicRepository->getAll(false);
        return view('post.create', compact('tags', 'topics', 'user'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)

    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
