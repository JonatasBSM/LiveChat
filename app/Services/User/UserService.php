<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Interfaces\UsersInterface;

class UserService
{

    public function __construct(protected UsersInterface $usersRepository)
    {

    }

    public function search(string $column, string $query, int $authId) {

        return User::where($column, 'like', '%'.$query.'%')
            ->where('id', '!=', $authId)->get();
            
    }
}
