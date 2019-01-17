<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Role;
use App\Domain\User;
use App\Domain\Project;
use App\Domain\Task;
use App\Domain\SubTask;

class Member extends Model
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
}