<?php

namespace App\Providers;

use App\Contracts\VerifyInterface;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Services\Auth\EmailVerificationService;
use App\Services\Auth\VerifyEmailService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostService::class, function ($app) {
            return new PostService($app->make(Post::class));
        });


        $this->app->bind(VerifyInterface::class, EmailVerificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
