<?php

namespace App\Repositories\Eloquent;

use App\Models\Message;
use App\Repositories\Interfaces\MessagesInterface;
use App\Repositories\Eloquent\Repository;

class MessagesRepository extends Repository implements MessagesInterface {

    public function __construct() {
        parent::__construct(new Message());
    }

}