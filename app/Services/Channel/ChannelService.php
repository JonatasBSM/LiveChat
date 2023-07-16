<?php

namespace App\Services\Channel;


use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ChannelService
{

    public function createChannel($users) {

        DB::beginTransaction();
        try {

            $channel = new Channel();
            $channel->save();
            $channel->users()->sync($users);
            DB::commit();

        } catch (QueryException $exception) {
            DB::rollback();
        }

    }
}
