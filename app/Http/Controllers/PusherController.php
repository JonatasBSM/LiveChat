<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Http\Requests\BroadcastMessageRequest;
use App\Http\Requests\NewBroadcastRequest;
use App\Services\Channel\Facades\Channel;
use App\Services\Pusher\PusherService;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{

    public function __construct(protected PusherService $pusherService)
    {

    }

    public function broadcast(BroadcastMessageRequest $request) {

        $message = $request->validated();

        $this->pusherService->broadcast($message);

    }

    public function newBroadcast(NewBroadcastRequest $request) {

        $data = $request->validated();

        $newChannel = $this->pusherService->newBroadcast($data);
        $formattedChannel = Channel::formattedChannel($newChannel);
        return response()->json([
            'status' => 200,
            'channel' => $formattedChannel
        ]);
    }

    public function listen() {

    }
}
