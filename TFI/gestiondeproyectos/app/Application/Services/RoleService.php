<?php

namespace App\Application\Services;
use App\Domain\Role;

class RoleService{
    public function findAll(){
        return Role::all();
    }

    public function findById($id){
        return Role::find($id);
    }

    public function save($role){
        return $role->save();
    }

    public function update($item,$id){
        $role = $this->findById($id);

        $role->name = $item->name;
        $role->description = $item->description;

        return $role->save();
    }

    public function delete($id)
    {
        $role = $this->findById($id);

        return $role->delete();
    }
}