<?php

namespace Api\Controllers;

use Api\Requests\Task\IndexRequest;
use Api\Requests\Task\UpsertRequest;
use App\Application\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Models\TaskModel;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {
    }

    public function index(IndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json($this->taskService->getBy(...$validated));
    }

    public function getByUuid(string $uuid): JsonResponse
    {
        return response()->json($this->taskService->getByUuid($uuid));
    }

    public function store(UpsertRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json($this->taskService->save(...$validated));
    }

    public function update(string $uuid, UpsertRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['uuid'] = $uuid;

        return response()->json($this->taskService->update(...$validated));
    }

    public function destroy(string $uuid): JsonResponse
    {
        $this->taskService->destroy($uuid);

        return response()->json();
    }
}
