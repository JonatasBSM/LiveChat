<?php

namespace App\Services\Channel;

use App\Repositories\Interfaces\ChannelsInterface;

class ChannelService
{

    public function __construct(protected ChannelsInterface $channelsRepository)
    {

    }

    public function formattedChannel($authUser) {
        $formattedChannels = $authUser->channels()->with(['users', 'messages'])->get()->map(function ($channel) use ($authUser) {
            $channel->partners = $channel->users->filter(fn ($user) => $user->id != $authUser->id)->values();
            $channel->preview = $channel->messages->isEmpty() ? '': $channel->messages->last();
            return $channel;
        });

        return $formattedChannels;
    }

    public function createChannel($newChannel) {
        
        $this->channelsRepository->create($newChannel);
        
    }
}
