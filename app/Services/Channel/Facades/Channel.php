<?php

namespace App\Services\Channel\Facades;

use App\Services\Channel\ChannelService;
use Illuminate\Support\Facades\Facade;

class Channel extends Facade
{
    protected static function getFacadeAccessor() {
        return ChannelService::class;
    }
}
