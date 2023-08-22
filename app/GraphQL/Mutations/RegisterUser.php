<?php

namespace App\GraphQL\Mutations;

use App\Services\UserService;

final class RegisterUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $input = $args['input'];

       $userService = app(UserService::class);

       return $userService->createUser($data = $this->getUserData($input));
       
    }

    protected function getUserData($input):array
    {
        return [
            'name'=> $input['name'],
            'email'=> $input['email'],
            'password'=> bcrypt('password')
        ];
    }
}
