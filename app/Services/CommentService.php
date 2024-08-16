<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Repositories\CmtRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CommentService {
    protected $postRepository, $cmtRepository, $userRepository;

    public function __construct(CmtRepository $cmtRepo, PostRepository $postRepo, UserRepository $userRepo)
    {
        $this->postRepository = $postRepo;
        $this->cmtRepository = $cmtRepo;
        $this->userRepository = $userRepo;
    }

    public function markResolve($cmt_id, $post_id, $user_id) {
        $post = $this->postRepository->getPostById($post_id);
        $cmt = $this->cmtRepository->getCmtById($cmt_id);
        $user = $this->userRepository->getUserById($user_id);
        if ($cmt->post_id !== $post->id) {
            throw new \Exception('This comment does not belong to this post');
        }

        if ($user_id === Auth::user()->id) {
            throw new \Exception('You can not mark you comment as resolved');
        }

        $post->status = Config::get('constants.POST_STATUS_RESOLVE');
        $cmt->is_solution = true;
        $user->points++;
        $post->save();
        $cmt->save();
        $user->save();
        return true;
    }

    public function create(CommentRequest $request) {
        $data = $request->validated();
        $comment = $this->cmtRepository->create($data);
        $search = [
            ['id', '<=', $comment->id],
            ['post_id', '=', $comment->post->id]
        ];
        $comment->currPage = ceil($this->cmtRepository->search($search)->count() / Config::get('constants.PER_PAGE'));
        return $comment;
    }
}
