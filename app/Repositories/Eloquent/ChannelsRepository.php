<?php

namespace App\Repositories\Eloquent;

use App\Models\Channel;
use App\Repositories\Interfaces\ChannelsInterface;
use App\Services\Channel\ChannelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ChannelsRepository extends Repository implements ChannelsInterface
{
    public function __construct(protected ChannelService $service)
    {
        parent::__construct( new Channel());
    }

    public function createChannel($users) {

        DB::beginTransaction();
        try {
            $channel = $this->model;
            $this->create();
            $channel->users()->sync($users);
            DB::commit();

        } catch (QueryException $exception) {
            DB::rollback();
            throw new \Exception($exception);
        }

    }

    public function formattedChannels($user) {
        return $this->service->formattedChannel($user);
    }

}
