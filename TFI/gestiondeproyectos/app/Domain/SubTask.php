<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    public $timestamps = false;

    protected $fillable = ['name','estimated','remaining','status','member_id','task_id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
