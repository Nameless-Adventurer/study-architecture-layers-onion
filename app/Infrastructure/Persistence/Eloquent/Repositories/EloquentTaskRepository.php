<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Task\Entities\Task;
use App\Domain\Task\Repositories\TaskRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\TaskModel;
use Illuminate\Support\Facades\DB;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    /**
     * @throws \JsonException
     */
    public function save(Task $task): Task
    {
        DB::beginTransaction();
        try {
            $taskModel = TaskModel::create([
                'name' => $task->getName(),
                'description' => $task->getDescription(),
                'status' => $task->getStatus()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \JsonException($e->getMessage(), code: 428);
        }

        return new Task(
            $taskModel->name,
            $taskModel->description,
            $taskModel->created_at,
            $taskModel->status,
            $taskModel->uuid
        );
    }

    public function getByUuid(string $uuid): ?Task
    {
        $taskModel = TaskModel::query()->find($uuid);

        return !$taskModel ?
            null :
            new Task(
                $taskModel->name,
                $taskModel->description,
                $taskModel->created_at,
                $taskModel->status,
                $taskModel->uuid,
            );
    }

    public function getBy(int $currentPage = 1, array $filters = [], array $sortBy = [], int $perPage = 10,): array
    {
        return TaskModel::query()
            ->when(isset($filters['status']), fn($q) => $q->whereIn('status', $filters['status']))
            ->when(
                !empty($sortBy),
                fn($q) => $q->orderBy($sortBy['by'], $sortBy['direction']),
                fn($q) => $q->orderBy('created_at', 'desc')
            )
            ->orderBy($sortBy['by'], $sortBy['direction'])
            ->forPage($currentPage, $perPage)
            ->get()
            ->map(fn(TaskModel $taskModel) => new Task(
                $taskModel->name,
                $taskModel->description,
                $taskModel->created_at,
                $taskModel->status,
                $taskModel->uuid,
            ))->toArray();
    }

    /**
     * @throws \JsonException
     */
    public function update(Task $task): Task
    {
        $taskModel = TaskModel::find($task->getUuid());

        DB::beginTransaction();
        try {
            $taskModel->update([
                'name' => $task->getName(),
                'description' => $task->getDescription(),
                'status' => $task->getStatus(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \JsonException($e->getMessage(), code: 428);
        }

        return $task;
    }

    public function delete(string $uuid): void
    {
        TaskModel::destroy($uuid);
    }
}
