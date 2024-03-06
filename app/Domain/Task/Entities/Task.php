<?php

namespace App\Domain\Task\Entities;

class Task
{
    use TaskGetters,
        TaskSetters;

    public function __construct(
        private ?string $name,
        private ?string $description,
        private ?string $created_at,
        private ?string $status,
        private ?string $uuid,
    ) {
    }
}
