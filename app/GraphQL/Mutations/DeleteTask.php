<?php

namespace App\GraphQL\Mutations;

use App\Services\TaskService;

final class DeleteTask
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = $args['id'];

        $taskService = app(TaskService::class);

        return $taskService->deleteTask($id);
    }
}
