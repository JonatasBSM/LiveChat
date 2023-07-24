<?php

namespace App\Services\Channel;

use App\Models\Channel;
use App\Repositories\Interfaces\ChannelsInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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

    public function createChannel($data) {

        $users = [
            $data['auth_id'],
            $data['partner_id']
        ];

        $channel = [
            'icon' => $data['icon'],
            'category_id' => $data['category_id']
        ];

        DB::beginTransaction();
        try {


            $filledChannel = Channel::create($channel);
            $filledChannel->users()->sync($users);
            
            DB::commit();

        } catch (QueryException $exception) {
            DB::rollback();
            throw new \Exception($exception);
        }

        return $filledChannel->id;

    }
}
