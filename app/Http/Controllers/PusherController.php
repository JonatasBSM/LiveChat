<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Http\Requests\BroadcastMessageRequest;
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

    public function listen() {

    }
}
