<?php

namespace App\Repositories\Contracts;

use App\Models\Task;

interface TaskRepositoryContract
{
    public function create(array $data): Task;

    public function get(string $id): Task;

    public function update(array $data, string $id): Task;

    public function delete(string $id);
}
