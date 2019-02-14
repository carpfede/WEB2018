<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Task extends Model 
{
    public $timestamps = false;

    protected $fillable = ['name','priority','status','type','description','member_id','sprint_id'];

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

    public function remaining()
    {
        return $this->subTasks->sum('remaining');
    }
}
