<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicDelManyRequest;
use App\Http\Requests\TopicRequest;
use Illuminate\Http\Request;
use App\Services\TopicService;
use App\Repositories\TopicRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class TopicController extends Controller
{
    protected $topicService, $topicRepository;

    public function __construct(TopicService $service, TopicRepository $repository)
    {
        $this->topicService = $service;
        $this->topicRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = $this->topicRepository->getAll();
        return view('topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request)
    {
        $this->topicService->create($request);
        Session::flash('success', 'User created');
        return redirect()->route('topic.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $topic = $this->topicRepository->getTopicById($id);
        return view('topic.update', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, $id)
    {
        $this->topicService->update($request ,$id);
        Session::flash('success', 'Topic updated');
        return redirect()->route('topic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->topicService->delete($id);
        Session::flash('success', 'Topic deleted');
        return redirect()->back();
    }

    public function deleteMany(TopicDelManyRequest $request) {
        $this->topicService->deleteMany($request->ids);
        Session::flash('success', 'Topics deleted');
        return redirect()->back();
    }

    public function topicDetail($id) {
        $topic = $this->topicRepository->getWithPost($id);
        return view('topic.topic-detail', compact('topic'));
    }
}
