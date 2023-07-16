<?php

namespace App\Repositories\Interfaces;

interface ChannelsInterface
{
    public function createChannel($users);

    public function formattedChannels($user);
}
