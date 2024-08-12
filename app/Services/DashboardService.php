<?php

namespace App\Services;

use App\Repositories\TopicRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Config;

class DashboardService {
    protected $topicRepository, $postRepository;

    public function __construct(TopicRepository $topicRepo, PostRepository $postRepo)
    {
        $this->topicRepository = $topicRepo;
        $this->postRepository = $postRepo;
    }

    public function getIndexData() {
        $topics = $this->topicRepository->getAll(false)->load(['post', 'latestPost', 'comment']);
        $topicsWithPost = $this->topicRepository->getWithPost();
        $posts = $this->postRepository->getNewestPost(Config::get('constants.LIMIT_POST'))->load('user');
        return ['topics' => $topics, 'topicsWithPost' => $topicsWithPost, 'newestPosts' => $posts];
    }
}
