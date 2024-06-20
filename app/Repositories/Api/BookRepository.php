<?php

namespace App\Repositories\Api;

use App\Repositories\Api\Interfaces\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function findAll()
    {
        return Book::orderBy('created_at', 'desc')->get();
    }

    public function findOne(String $id): Book
    {
        return Book::find($id);
    }

    public function update(String $id, Array $data)
    {
        Book::whereId($id)->update($data);
    }

    public function delete(String $id)
    {
        Book::whereId($id)->delete();
    }
}
