<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChannelRequest;
use App\Models\User;
use App\Repositories\Interfaces\ChannelsInterface;
use App\Repositories\Interfaces\UsersInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChannelsController extends Controller
{

    public function __construct(protected ChannelsInterface $channelsRepository, protected UsersInterface $usersRepository)
    {
    }

    public function create(CreateChannelRequest $request) {
        $users = $request->validated();
        $this->channelsRepository->createChannel($users);
    }

    public function index() {

        $user = Auth::user();

        return Inertia::render('LiveChat', [
            'chats' => $this->channelsRepository->formattedChannels($user),
            'user' => $user
        ]);

    }
}
