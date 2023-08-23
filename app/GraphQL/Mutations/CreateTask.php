<?php

namespace App\GraphQL\Mutations;

use App\Services\TaskService;

final class CreateTask
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

    
        $input = $args['input'];

        $taskService = app(TaskService::class);

        return $taskService->createTask($input);
    }
}
