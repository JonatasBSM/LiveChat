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
        $user1 = User::find(1)->id;
        $user2 = User::find(2)->id;

        $users = [
            $user1,
            $user2
        ];

        $service = new ChannelService();

        $service->createChannel($users);
    }
}
