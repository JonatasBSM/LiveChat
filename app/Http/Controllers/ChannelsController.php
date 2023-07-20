<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChannelRequest;
use App\Services\Channel\ChannelService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChannelsController extends Controller
{

    public function __construct(protected ChannelService $channelService)
    {
        
    }

    public function create(CreateChannelRequest $request) {
        $channel = $request->validated();
        $this->channelService->createChannel($channel);
    }

    public function index() {

        $user = Auth::user();

        return Inertia::render('LiveChat', [
            'chats' => $this->channelService->formattedChannel($user),
            'user' => $user
        ]);

    }
}
