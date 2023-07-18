<?php

namespace App\Services\Pusher;

use App\Events\MessageSentEvent;
use App\Repositories\Interfaces\MessagesInterface;

class PusherService {

    public function __construct(protected MessagesInterface $messagesRepository)
    {

    }

    public function broadcast($message) {

        $newMessage = $this->messagesRepository->fill($message);
        $newMessage->save();

        broadcast(new MessageSentEvent($newMessage))->toOthers();

    }
}
