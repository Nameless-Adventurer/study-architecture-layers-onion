<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasUuids;

    protected $table = 'tasks';
    protected $fillable = ['name', 'description', 'status',];
    protected $primaryKey = 'uuid';

    public $incrementing = false;
}
