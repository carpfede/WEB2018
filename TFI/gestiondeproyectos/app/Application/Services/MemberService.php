<?php

namespace App\Application\Services;
use App\Domain\Member;
use App\Domain\User;
use App\Application\Services\UserService;
use Illuminate\Support\Facades\Auth;

class MemberService{

    private $userservice;

    public function __construct(UserService $userservice) {
        $this->userservice = $userservice;
    }

    public function findAll(){
        return Member::wherehas('user', function($u) { $u->where('disabled',0); })->get();
    }

    public function findById($id){
        return Member::find($id);
    }

    public function save($member){
        $isValid = $member->save();
        
        if(!$isValid){
            return false;
        }

        $user = new User();
        
        $user->username = strtolower($member->firstName[0].str_replace(' ', '', $member->lastName));
        $user->password = bcrypt('123456');
        $user->remember_token = str_random(10);
        $user->disabled = false;
        $user->member_id = $member->id;

        return $this->userservice->save($user) && $isValid;    
    }

    public function update($item,$id){
        $member = $this->findById($id);

        $member->firstName = $item->firstName;
        $member->lastName = $item->lastName;
        $member->address = $item->address;
        $member->birthday = $item->birthday;
        $member->CUIT = $item->CUIT;
        $member->email = $item->email;
        $member->role_id = $item->role_id;

        $user = $member->user;

        $user->username = strtolower($member->firstName[0].str_replace(' ', '', $member->lastName));

        $isValid = $this->userservice->update($user, $user->id);

        return $member->save() && $isValid;
    }

    public function delete($id)
    {
        $member = $this->findById($id);

        return $member->delete();
    }

    public function findSubtasks(){
        return Auth::user()->member->subTasks;
    }
}