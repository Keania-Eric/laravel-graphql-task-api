<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(public UserRepositoryContract $userRepository)
    {
    }

    public function createUser(array $userData): User
    {
        return $this->userRepository->create($userData);
    }

    public function login(array $userData)
    {
        $user = $this->userRepository->findByEmail($userData['email']);

        if (! $user || ! Hash::check($userData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        return $user->createToken('AuthToken');
    }
}
