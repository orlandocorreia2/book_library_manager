<?php

namespace App\Repositories\Api\Interfaces;

use App\Models\Author;

interface AuthorRepositoryInterface
{
    public function create(array $data): Author;
    public function findAll();
    public function findOne(String $id): Author;
    public function update(String $id, Array $data);
    public function delete(String $id);
}
