<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\UpdateBookServiceInterface;
use App\Services\Api\Interfaces\FindOneBookServiceInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Api\UpdateBookRequest;

class UpdateBookService implements UpdateBookServiceInterface
{
    private BookRepositoryInterface $bookRepositoryInterface;
    private FindOneBookServiceInterface $findOneBookServiceInterface;

    public function __construct(
        BookRepositoryInterface $bookRepositoryInterface,
        FindOneBookServiceInterface $findOneBookServiceInterface,
    ) {
        $this->bookRepositoryInterface = $bookRepositoryInterface;
        $this->findOneBookServiceInterface = $findOneBookServiceInterface;
    }

    public function execute(String $id, UpdateBookRequest $request) {
        $author = auth()->user()->author;
        if (!$author) {
            throw new UnauthorizedException('Unauthorized');
        }
        $book = $this->findOneBookServiceInterface->execute($id);
        if (!$book) {
            throw new NotFoundException('Book not found');
        }
        $is_owner_book = $book->authors()->where(['author_id' => $author->id]))->first();
        if (!$is_owner_book) {
            throw new UnauthorizedException('Only book authors can make updates');
        }
        $this->bookRepositoryInterface->update($id, [
            'title' => $request->title,
            'year_publication' => $request->year_publication,
        ]);
        $request_authors_id = $request->authors_id ? array_filter($request->authors_id) : [];
        $authors_id = array_merge($request_authors_id, [$author->id]);
        $book->authors()->sync($authors_id);
    }
}
