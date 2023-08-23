<?php

namespace App\Providers;

use App\Repositories\Contracts\TaskRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(TaskRepositoryContract::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
