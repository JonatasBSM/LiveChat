<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function broadcast(Request $request) {

        $user = Auth::user();
        $message = $request->get('message');

        broadcast(new MessageSentEvent($user, $message))->toOthers();

    }

    public function listen() {

    }
}
