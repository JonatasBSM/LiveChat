<?php

namespace App\Services\User;

use App\Repositories\Interfaces\UsersInterface;

class UserService
{

    public function __construct(protected UsersInterface $usersRepository)
    {

    }

    public function search(string $column, string $query, int $authId) {
        return $this->usersRepository->like($column, $query)
            ->where('id', '!=', $authId);
    }
}
