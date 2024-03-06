<?php

namespace App\Enums;

use App\Infrastructure\Persistence\Eloquent\Models\TaskModel;

enum TaskEnum: string
{
    case STATUS_DONE = 'done';
    case STATUS_IN_PROGRESS = 'in_progress';
    case STATUS_IN_PENDING = 'in_pending';

    public static function getTaskAttributes(): array
    {
        return (new TaskModel())->getAttributes();
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_DONE->value,
            self::STATUS_IN_PROGRESS->value,
            self::STATUS_IN_PROGRESS->value,
        ];
    }
}
