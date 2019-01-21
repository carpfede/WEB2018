<?php

namespace App\Application\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectService{

    public function findAll()
    {
        return \App\Domain\Project::all();
    }

    public function findCurrent(){
        return Auth::user()->projects;
    }
}