<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = ['name','description','system'];

    protected $casts = [
        'system' => 'boolean',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}