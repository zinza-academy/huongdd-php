<?php

namespace App\Providers;

use App\ViewComposers\FooterComposer;
use App\ViewComposers\NewestPostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.footer-list', FooterComposer::class);
        View::composer('components.newest-post', NewestPostComposer::class);
    }
}
