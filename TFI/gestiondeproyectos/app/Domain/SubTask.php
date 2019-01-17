<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    public function member()
    {
        return $this->belongsTo(Memmber::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
