<?php

namespace App\GraphQL\Mutations;

use App\Services\UserService;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $input = $args['input'];

        $userService = app(UserService::class);

        $data = $userService->login($input);

        return [
            'token' => $data->plainTextToken,
        ];
    }
}
