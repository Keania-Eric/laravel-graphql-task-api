<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryContract;
use Illuminate\Support\Facades\Gate;

class TaskService
{
    public function __construct(public TaskRepositoryContract $taskRepository)
    {
    }

    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function getTask(string $id): Task
    {
        return $this->taskRepository->get($id);
    }

    public function updateTask(array $data, string $id): Task
    {

        $task = $this->getTask($id);

        Gate::authorize('update', $task);

        return $this->taskRepository->update($data, $id);
    }

    public function deleteTask(string $id)
    {
        $task = $this->getTask($id);

        Gate::authorize('delete', $task);

        return $this->taskRepository->delete($id);
    }
}
