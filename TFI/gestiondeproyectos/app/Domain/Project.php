<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }
}