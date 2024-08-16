<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\CommentUserLike;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function store(LikeRequest $request) {
        $like = CommentUserLike::withTrashed()->where('comment_id', $request->comment_id)->where('user_id', $request->user_id)->first();
        if ($like && $like->trashed()){
            $like->restore();
        } else {
            CommentUserLike::create($request->validated());
        }
        return response()->json(['success' => 'liked']);
    }

    public function delete(LikeRequest $request) {
        CommentUserLike::where('comment_id', $request->comment_id)->where('user_id', $request->user_id)->delete();
        return response()->json(['success' => 'disliked']);
    }
}
