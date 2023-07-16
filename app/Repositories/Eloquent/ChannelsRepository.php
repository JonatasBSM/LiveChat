<?php

namespace App\Repositories\Eloquent;

use App\Models\Channel;
use App\Repositories\Interfaces\ChannelsInterface;
use Illuminate\Database\Eloquent\Model;

class ChannelsRepository extends Repository implements ChannelsInterface
{
    public function __construct()
    {
        parent::__construct( new Channel());
    }
}
