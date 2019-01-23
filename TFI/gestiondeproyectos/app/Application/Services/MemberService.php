<?php

namespace App\Application\Services;
use App\Domain\Member;
use App\Application\Services\UserService;

class MemberService{

    private $userservice;

    public function __construct(UserService $userservice) {
        $this->userservice = $userservice;
    }

    public function findAll(){
        return Member::all();
    }

    public function findById($id){
        return Member::find($id);
    }

    public function save($member){
        return $member->save();
    }

    public function update($item,$id){
        $member = $this->findById($id);

        $member->firstName = $item->firstName;
        $member->lastName = $item->lastName;
        $member->address = $item->address;
        $member->birthday = $item->birthday;
        $member->CUIT = $item->CUIT;
        $member->email = $item->email;
        $member->role = $item->role;

        $user = $member->user;

        $user->username = $member->firstName[0].$member->lastName;

        $isValid = $this->userservice->update($user, $user->id);

        return $member->save() && $isValid;
    }

    public function delete($id)
    {
        $member = $this->findById($id);

        return $member->delete();
    }
}