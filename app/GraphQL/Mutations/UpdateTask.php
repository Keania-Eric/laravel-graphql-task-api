<?php

namespace App\GraphQL\Mutations;

use App\Services\TaskService;

final class UpdateTask
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $input = $args['input'];
        $id = $args['id'];

        $taskService = app(TaskService::class);

        return $taskService->updateTask($input, $id);
    }
}
