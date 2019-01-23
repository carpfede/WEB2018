<?php

namespace App\Application\Services;

class UserService{

    public function findOne($username)
    {
        return \App\Domain\User::where('username', $username)
                ->where('disabled', false)
                ->first();
    }

}