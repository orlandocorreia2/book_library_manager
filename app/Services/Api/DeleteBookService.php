<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\DeleteBookServiceInterface;
use App\Services\Api\Interfaces\FindOneBookServiceInterface;
use App\Repositories\Api\Interfaces\BookRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;

class DeleteBookService implements DeleteBookServiceInterface
{
    private FindOneBookServiceInterface $findOneBookServiceInterface;
    private BookRepositoryInterface $bookRepositoryInterface;

    public function __construct(
        FindOneBookServiceInterface $findOneBookServiceInterface,
        BookRepositoryInterface $bookRepositoryInterface,
    ) {
        $this->findOneBookServiceInterface = $findOneBookServiceInterface;
        $this->bookRepositoryInterface = $bookRepositoryInterface;
    }

    public function execute(String $id) {
        $book = $this->findOneBookServiceInterface->execute($id);
        if (!$book) {
            throw new NotFoundException('Book not found');
        }
        $is_owner_book = $book->authors()->where(['author_id' => auth()->user()->author->id]))->first();
        if (!$is_owner_book) {
            throw new UnauthorizedException('Only book authors can make updates');
        }
        $this->bookRepositoryInterface->delete($id);
    }
}
