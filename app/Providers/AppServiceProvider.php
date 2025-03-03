<?php

namespace App\Providers;

use App\Contracts\VerifyInterface;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Services\Auth\EmailVerificationService;
use App\Services\Auth\VerifyEmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostController::class, function ($app) {
            return new PostController($app->make(Post::class));
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
