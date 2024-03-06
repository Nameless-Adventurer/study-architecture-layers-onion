<?php

namespace App\Domain\Task\Repositories;

use App\Domain\Task\Entities\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): Task;

    public function getByUuid(string $uuid): ?Task;

    public function getBy(
        int $currentPage = 1,
        array $filters = [],
        array $sortBy = ['by' => 'created_at', 'direction' => 'desc'],
        int $perPage = 10,
    ): array;

    public function update(Task $task): Task;

    public function delete(string $uuid): void;
}
