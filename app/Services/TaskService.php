<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryContract;

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
        return $this->taskRepository->update($data, $id);
    }

    public function deleteTask(string $id)
    {
        return $this->taskRepository->delete($id);
    }
}
