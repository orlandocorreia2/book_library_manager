<?php

namespace App\Repositories\Api;

use App\Repositories\Api\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findAll()
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function findOne(String $id): User
    {
        return User::find($id);
    }

    public function update(String $id, Array $data)
    {
        return User::whereId($id)->update($data);
    }
}
