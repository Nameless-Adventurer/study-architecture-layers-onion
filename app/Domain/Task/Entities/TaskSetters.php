<?php

namespace App\Domain\Task\Entities;

trait TaskSetters
{
    public function setName(string $name): Task
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription(string $description): Task
    {
        $this->description = $description;

        return $this;
    }

    public function setStatus(string $status): Task
    {
        $this->status = $status;

        return $this;
    }
}
