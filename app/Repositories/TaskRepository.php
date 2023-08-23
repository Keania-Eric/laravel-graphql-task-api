<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryContract;

class TaskRepository implements TaskRepositoryContract
{
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function get(string $id): Task
    {
        return Task::findOrFail($id);
    }

    public function update(array $data, string $id): Task
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }

    public function delete(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
