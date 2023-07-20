<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\Interfaces\ChannelsInterface;
use App\Repositories\Interfaces\UsersInterface;
use App\Services\Channel\ChannelService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChannelCreationTest extends TestCase
{

    public function test_example(): void
    {
        $user1 = User::find(19)->id;
        $user2 = User::find(20)->id;
        $this->actingAs(User::find(20))->post('/create', [
            'user1' => $user1,
            'user2' => $user2,
            'category' => 1
        ]);

        $this->assertDatabaseCount('channel_user', 2);
    }
}
