<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagDelManyRequest;
use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    protected $tagService, $tagRepository;

    public function __construct(TagService $service, TagRepository $repository)
    {
        $this->tagService = $service;
        $this->tagRepository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tagRepository->getAll();
        return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $this->tagService->create($request);
        Session::flash('success', 'User created');
        return redirect()->route('tag.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->getTagById($id);
        return view('tag.update', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, $id)
    {
        $this->tagService->update($request ,$id);
        Session::flash('success', 'tag updated');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->tagService->delete($id);
        Session::flash('success', 'tag deleted');
        return redirect()->back();
    }

    public function deleteMany(TagDelManyRequest $request) {
        $this->tagService->deleteMany($request->ids);
        return response()->json(['success' => 'deleted']);
    }

    public function getTag(Request $request) {
        return $this->tagService->getTag($request);
    }
}
