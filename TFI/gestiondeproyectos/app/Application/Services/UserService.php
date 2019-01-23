<?php

namespace App\Application\Services;

use App\Domain\User;

class UserService{

    public function findOne($username)
    {
        return User::where('username', $username)
                ->where('disabled', false)
                ->first();
    }

    public function update($item, $id){
        $user = User::find($id);

        $user->username = $item->username;
        $user->password = $item->password;
        $user->disabled = $item->disabled;

        return $user->save();
    }
}