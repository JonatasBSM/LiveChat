<?php

namespace App\Services\Pusher;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Services\Channel\ChannelService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PusherService {

    public function __construct(protected ChannelService $channelService)
    {

    }

    public function broadcast($message) {

        $newMessage = Message::create($message);
        broadcast(new MessageSentEvent($newMessage))->toOthers();

    }

    public function newBroadcast(mixed $data) {

        DB::beginTransaction();

        try {

            $newChannel = $this->channelService->createChannel($data);

            $message = [
                'content' => $data['content'],
                'user_id' => $data['auth_id'],
                'channel_id' => $newChannel->id
            ];

            $newMessage = Message::create($message);

            DB::commit();

        } catch(QueryException $exception) {
            DB::rollBack();
            throw $exception;
        }

        broadcast(new MessageSentEvent($newMessage))->toOthers();

    }
}
