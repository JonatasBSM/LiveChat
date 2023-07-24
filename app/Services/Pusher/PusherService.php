<?php

namespace App\Services\Pusher;

use App\Events\MessageSentEvent;
use App\Repositories\Interfaces\MessagesInterface;
use App\Services\Channel\ChannelService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PusherService {

    public function __construct(protected MessagesInterface $messagesRepository, protected ChannelService $channelService)
    {

    }

    public function broadcast($message) {

        $newMessage = $this->messagesRepository->fill($message);
        $newMessage->save();

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

            $newMessage = $this->messagesRepository->fill($message);
            $newMessage->save();

            DB::commit();

        } catch(QueryException $exception) {
            DB::rollBack();
            throw $exception;
        }

        broadcast(new MessageSentEvent($newMessage))->toOthers();

    }
}
