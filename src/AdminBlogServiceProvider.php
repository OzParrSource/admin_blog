<?php

namespace Ozparr\AdminBlog;

use Illuminate\Support\ServiceProvider;

class AdminBlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->publishes([
            __DIR__ . '/assets' => public_path('assets'),
        ], 'public');
        $this->loadViewsFrom(__DIR__ . '/Views', 'admin_blog');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Ozparr\AdminBlog\Controllers\BlogController');

    }
}
