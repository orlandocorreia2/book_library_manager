<?php

namespace App\Repositories\Api;

use App\Repositories\Api\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function findAll()
    {
        return Author::orderBy('created_at', 'desc')->get();
    }

    public function findOne(String $id): Author
    {
        return Author::find($id);
    }

    public function update(String $id, Array $data)
    {
        Author::whereId($id)->update($data);
    }

    public function delete(String $id)
    {
        Author::whereId($id)->delete();
    }
}
