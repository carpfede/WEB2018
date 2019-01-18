<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}