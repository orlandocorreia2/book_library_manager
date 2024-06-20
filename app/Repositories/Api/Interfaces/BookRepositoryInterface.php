<?php

namespace App\Repositories\Api\Interfaces;

use App\Models\Book;

interface BookRepositoryInterface
{
    public function create(array $data): Book;
    public function findAll();
    public function findOne(String $id): Book;
    public function update(String $id, Array $data);
    public function delete(String $id);
}
