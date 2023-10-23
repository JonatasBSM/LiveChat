<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\ChannelUser;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class NewChannelBroadcastCreationTest extends TestCase
{

    public function test_example(): void
    {
        $user1 = User::find(4)->id;
        $user2 = User::find(5)->id;

        $channelUserCount = ChannelUser::all()->count();
        $channelCount = Channel::all()->count();
        $messageCount = Message::all()->count();

        $this->actingAs(User::find(4))->post('/pusher/broadcast/new-channel', [
            'auth_id' => $user1,
            'partner_id' => $user2,
            'icon' => null,
            'category_id' => 1,
            'content' => 'masqueico'
        ]);

        $this->assertDatabaseCount('channel_user', $channelUserCount + 2);
        $this->assertDatabaseCount('channels', $channelCount + 1);
        $this->assertDatabaseCount('messages', $messageCount + 1);

    }
}
