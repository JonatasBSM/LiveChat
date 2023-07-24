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
        $user1 = User::find(7)->id;
        $user2 = User::find(8)->id;
        $response = $this->actingAs(User::find(7))->post('/create', [
            'auth_id' => $user1,
            'partner_id' => $user2,
            'icon' => null,
            'category_id' => 1
        ]);

        $response->assertStatus(200);
        $response->assertDatabaseCount('channel_user', 2);
    }
}
