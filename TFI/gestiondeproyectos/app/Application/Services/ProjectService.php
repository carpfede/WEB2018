<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\Auth;
use App\Domain\Project;
use App\Domain\Task;

class ProjectService{

    public function findAll()
    {
        return Project::all();
    }

    public function findCurrent(){
        return Auth::user()->member->projects;
    }

    public function findById($id)
    {
        return Project::find($id);
    }

    public function save($project,$member)
    {
        $valid = $project->save();
        if($valid)
        {
            return $project->members()->sync($member);
        }

        return $valid;
    }

    public function saveSprint($sprint)
    {
        return $sprint->save();
    }

    public function saveTask($task)
    {
        return $task->save();
    }

    public function updateTask($id,$status)
    {
        $taks = Task::find($id);

        if(!$task){
            return false;
        }

        $taks->status = $status;

        return $task->save();
    }

    public function saveSubTask($subtask)
    {
        return $subtask->save();
    }

    public function updateMembers($project,$members){
        $p = $this->findById($project);
        return $p->members()->sync($members);
    }
}