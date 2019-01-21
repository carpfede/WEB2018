<?php

namespace App\Application\Services;

use Illuminate\Http\Request;

class ProjectService{

    public function findAll()
    {
        return \App\Domain\Project::all();
    }

}