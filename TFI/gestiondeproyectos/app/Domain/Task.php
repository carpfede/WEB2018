<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Task extends Model 
{
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
}
