<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\CreateBookServiceInterface;
use App\Services\Api\Interfaces\FindOneUserServiceInterface;
use App\Services\Api\Interfaces\UpdateUserServiceInterface;
use App\Repositories\Api\Interfaces\BookRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\SystemUnavailableException;
use App\Http\Requests\Api\CreateBookRequest;

class CreateBookService implements CreateBookServiceInterface
{
    private BookRepositoryInterface $bookRepositoryInterface;

    public function __construct(
        BookRepositoryInterface $bookRepositoryInterface,
    ) {
        $this->bookRepositoryInterface = $bookRepositoryInterface;
    }

    public function execute(CreateBookRequest $request): Array {
        $author = auth()->user()->author;
        if (!$author) {
            throw new UnauthorizedException('Unauthorized');
        }
        $book = $this->bookRepositoryInterface->create([
            'title' => $request->title,
            'year_publication' => $request->year_publication,
        ]);
        if (!$book) {
            throw new SystemUnavailableException('Book cannot be created, please try again later');
        }
        $request_authors_id = $request->authors_id ? array_filter($request->authors_id) : [];
        $authors_id = array_merge($request_authors_id, [$author->id]);
        $book->authors()->sync($authors_id);
        return [
            'id' => $book->id,
            'title' => $book->title,
            'year_publication' => $book->year_publication,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at
        ];
    }
}
