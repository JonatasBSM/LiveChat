<?php

namespace App\Services\Pusher;

use App\Events\MessageSentEvent;
use App\Repositories\Interfaces\MessagesInterface;

class PusherService {

    public function __construct(protected MessagesInterface $messagesRepository)
    {

    }

    public function broadcast($message) {

        $this->messagesRepository->fill($message);
        dd('salve');
        broadcast(new MessageSentEvent($message))->toOthers();

    }
}