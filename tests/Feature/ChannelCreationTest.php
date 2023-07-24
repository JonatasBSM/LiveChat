<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\ChannelUser;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class ChannelCreationTest extends TestCase
{

    public function test_example(): void
    {
        $user1 = User::find(1)->id;
        $user2 = User::find(2)->id;

        $channelUserCount = ChannelUser::all()->count();
        $channelCount = Channel::all()->count();

        $this->actingAs(User::find(1))->post('/channels/create', [
            'auth_id' => $user1,
            'partner_id' => $user2,
            'icon' => null,
            'category_id' => 1
        ]);

        $this->assertDatabaseCount('channel_user', $channelUserCount + 2);
        $this->assertDatabaseCount('channels', $channelCount + 1);

    }
}
