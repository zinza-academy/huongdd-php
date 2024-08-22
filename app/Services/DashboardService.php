<?php

namespace App\Services;

use App\Repositories\TopicRepository;
use App\Repositories\PostRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class DashboardService {
    protected $topicRepository, $postRepository;

    public function __construct(TopicRepository $topicRepo, PostRepository $postRepo)
    {
        $this->topicRepository = $topicRepo;
        $this->postRepository = $postRepo;
    }

    public function getIndexData() {
        // $topics = Cache::remember('topics', Config::get('constants.CACHE_LIFETIME'), function() {
        //     return $this->topicRepository->getAll(false)->load(['post', 'comment']);
        // });

        // $topicsWithPost = Cache::remember('topic_with_post', Config::get('constant.CACHE_LIFETIME'), function () {
        //     return $this->topicRepository->getAllWithPost();
        // });

        // $userLikes = Cache::remember('user_likes', Config::get('constants.CACHE_LIFETIME'), function() {
        //     return userWithMostLikes();
        // });
        $topics =  $this->topicRepository->getAll(false)->load(['post', 'comment']);
        $topicsWithPost = $this->topicRepository->getAllWithPost();
        $userLikes = userWithMostLikes();
        return [
            'topics' => $topics,
            'topicsWithPost' => $topicsWithPost,
            'userLikes' => $userLikes
        ];
    }
}
