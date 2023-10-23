<?php

namespace App\Http\Controllers;

use App\Services\Channel\ChannelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LiveChatController extends Controller
{
    public function __construct(protected ChannelService $channelService)
    {
        
    }

    public function index() {


        return Inertia::render('LiveChat');

    }
}
