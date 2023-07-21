<?php

namespace App\Providers;

use App\Repositories\Eloquent\ChannelsRepository;
use App\Repositories\Eloquent\MessagesRepository;
use App\Repositories\Eloquent\UsersRepository;
use App\Repositories\Interfaces\ChannelsInterface;
use App\Repositories\Interfaces\MessagesInterface;
use App\Repositories\Interfaces\UsersInterface;
use App\Services\Channel\ChannelService;
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
        $this->app->bind(MessagesInterface::class, MessagesRepository::class);
        $this->app->bind(ChannelService::class, function ($app) {
            return new ChannelService($app->make(ChannelsInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
