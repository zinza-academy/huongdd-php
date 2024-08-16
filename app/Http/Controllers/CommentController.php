<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Exception;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    protected $cmtService;

    public function __construct(CommentService $service)
    {
        $this->cmtService = $service;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $comment = $this->cmtService->create($request);
        Session::flash('success', 'Comment posted');
        return redirect()->route('post.detail', [$comment->post->id, 'page' => $comment->currPage]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function markResolve($cmt_id, $post_id, $user_id) {
        try {
            $this->cmtService->markResolve($cmt_id, $post_id, $user_id);
            Session::flash('success', 'Marked this post resolved!');
            return redirect()->back();
        } catch(Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

}
