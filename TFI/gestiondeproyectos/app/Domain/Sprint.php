<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    public $timestamps = false;

    protected $fillable = ['number','version','from', 'toEstimated', 'to', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}