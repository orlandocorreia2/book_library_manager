<?php

namespace App\Services\Api;

use App\Services\Api\Interfaces\FindAllBooksServiceInterface;
use App\Repositories\Api\Interfaces\BookRepositoryInterface;
use App\Exceptions\UnauthorizedException;

class FindAllBooksService implements FindAllBooksServiceInterface {

    private BookRepositoryInterface $bookRepositoryInterface;

    public function __construct(
        BookRepositoryInterface $bookRepositoryInterface
    ) {
        $this->bookRepositoryInterface = $bookRepositoryInterface;
    }

    public function execute() {
        return $this->bookRepositoryInterface->findAll();
    }
}
