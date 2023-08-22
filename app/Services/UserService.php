<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserService
{
    public function __construct(public UserRepositoryContract $userRepository)
    {
    }

    public function createUser(array $userData): User
    {
        return $this->userRepository->create($userData);
    }
}
