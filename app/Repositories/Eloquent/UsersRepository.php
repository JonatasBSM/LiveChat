<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UsersInterface;

class UsersRepository extends Repository implements UsersInterface
{
    public function __construct() {
        parent::__construct(new User());
    }

}
