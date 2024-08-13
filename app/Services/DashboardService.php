<?php

namespace App\Services;

use App\Repositories\TopicRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class DashboardService {
    protected $topicRepository, $postRepository, $userRepository;

    public function __construct(TopicRepository $topicRepo, PostRepository $postRepo, UserRepository $userRepo)
    {
        $this->topicRepository = $topicRepo;
        $this->postRepository = $postRepo;
        $this->userRepository = $userRepo;
    }

    public function getIndexData() {
        $topics = Cache::remember('topics', Config::get('constants.CACHE_LIFETIME'), function() {
            return $this->topicRepository->getAll(false)->load(['post', 'latestPost', 'comment']);
        });
        $topicsWithPost = Cache::remember('topic_with_post', Config::get('constant.CACHE_LIFETIME'), function () {
            return $this->topicRepository->getWithPost();
        });

        $userLikes = Cache::remember('user_likes', Config::get('constants.CACHE_LIFETIME'), function() {
            return $this->userRepository->getUsersWithMostLikes();
        });
        $posts = $this->postRepository->getNewestPost(Config::get('constants.LIMIT_RECORD'))->load('user');
        return [
            'topics' => $topics,
            'topicsWithPost' => $topicsWithPost,
            'newestPosts' => $posts,
            'userLikes' => $userLikes
        ];
    }
}
