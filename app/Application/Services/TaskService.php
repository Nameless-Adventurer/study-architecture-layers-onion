<?php

namespace App\Application\Services;

use App\Domain\Task\Entities\Task;
use App\Domain\Task\Repositories\TaskRepositoryInterface;

class TaskService
{
    public function __construct(private readonly TaskRepositoryInterface $taskRepository)
    {
    }

    public function getByUuid(string $uuid): ?Task
    {
        return $this->taskRepository->getByUuid($uuid);
    }

    public function getBy(...$args): array
    {
        return $this->taskRepository->getBy($args['currentPage'], $args['filters'] ?? [], $args['sortBy'] ?? [], $args['perPage'] ?? 10);
    }

    public function save(...$attributes): Task
    {
        $reflection = new \ReflectionClass(Task::class);
        $constructor = $reflection->getConstructor();
        $parameters = $constructor->getParameters();

        $assignAttributes = [];

        foreach ($parameters as $parameter) {
            $parameterName = $parameter->getName();
            $assignAttributes[$parameterName] = $attributes[$parameterName] ?? null;
        }

        return $this->taskRepository->save($reflection->newInstanceArgs($assignAttributes));
    }

    public function update(...$attributes): Task
    {
        $reflection = new \ReflectionClass(Task::class);
        $constructor = $reflection->getConstructor();
        $parameters = $constructor->getParameters();

        $assignAttributes = [];

        foreach ($parameters as $parameter) {
            $parameterName = $parameter->getName();
            $assignAttributes[$parameterName] = $attributes[$parameterName] ?? null;
        }

        return $this->taskRepository->update($reflection->newInstanceArgs($assignAttributes));
    }

    public function destroy(string $uuid): void
    {
        $this->taskRepository->delete($uuid);
    }
}
