<?php

namespace App\Repositories\Api\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function findAll();
    public function findOne(String $id): User;
    public function update(String $id, Array $data);
}
