<?php

namespace App\Providers;

use App\Repositories\Eloquent\ChannelsRepository;
use App\Repositories\Eloquent\UsersRepository;
use App\Repositories\Interfaces\ChannelsInterface;
use App\Repositories\Interfaces\UsersInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersInterface::class, UsersRepository::class);
        $this->app->bind(ChannelsInterface::class, ChannelsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
