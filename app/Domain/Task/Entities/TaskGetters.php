<?php

namespace App\Domain\Task\Entities;

trait TaskGetters
{
    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }
}
