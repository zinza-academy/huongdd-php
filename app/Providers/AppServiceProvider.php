<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('delete-user', function($user, $companyAcc) {
            return  $user->is_admin || ($user->role && !$companyAcc->role);
        });

        Gate::define('update-user', function($user, $companyAcc) {
            return  $user->is_admin || ($user->role && !$companyAcc->role);
        });

        Gate::define('delete-post', function ($user, $post) {
            $post->load('user');
            return  $user->is_admin ||
                    $user->id === $post->user_id ||
                    ($user->role && $user->company_id === $post->user->company_id);
        });

        Gate::define('update-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('mark-resolve', function($user, $comment) {
            $comment->load('post');
            $comment->post->load('user');
            return $user->id === $comment->post->user->id &&
                   $comment->post->status === Config::get('constants.POST_STATUS_NOTRESOLVED');
        });
    }
}
