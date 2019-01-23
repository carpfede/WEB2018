<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $timestamps = false;

    protected $fillable = ['firstName','lastName','address','birthday','CUIT','email','role'];

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