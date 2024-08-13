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
        $topics = Cache::remember('topics', Config::get('constants.CACHE_LIFETIME'), function() {
            return $this->topicRepository->getAll(false)->load(['post', 'latestPost', 'comment']);
        });
        $topicsWithPost = Cache::remember('topic_with_post', Config::get('constant.CACHE_LIFETIME'), function () {
            return $this->topicRepository->getWithPost();
        });

        $user_likes = Cache::remember('user_likes', Config::get('constants.CACHE_LIFETIME'), function() {
            return count_likes();
        });
        $posts = $this->postRepository->getNewestPost(Config::get('constants.LIMIT_RECORD'))->load('user');
        return [
            'topics' => $topics,
            'topicsWithPost' => $topicsWithPost,
            'newestPosts' => $posts,
            'user_likes' => $user_likes
        ];
    }
}
