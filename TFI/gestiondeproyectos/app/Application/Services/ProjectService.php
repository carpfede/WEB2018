<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\Auth;
use App\Domain\Project;

class ProjectService{

    public function findAll()
    {
        return Project::all();
    }

    public function findCurrent(){
        return Auth::user()->projects;
    }

    public function findById($id)
    {
        return Project::find($id);
    }

    public function save($project)
    {
        return $project->save();
    }

    public function saveSprint($sprint)
    {
        return $sprint->save();
    }

    public function saveTask($task)
    {
        return $task->save();
    }
}