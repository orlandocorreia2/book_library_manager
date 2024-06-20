<?php

namespace App\Services\Api;

use App\Services\Api\Interfaces\FindAllAuthorsServiceInterface;
use App\Repositories\Api\Interfaces\AuthorRepositoryInterface;
use App\Exceptions\UnauthorizedException;

class FindAllAuthorsService implements FindAllAuthorsServiceInterface {

    private AuthorRepositoryInterface $authorRepositoryInterface;

    public function __construct(
        AuthorRepositoryInterface $authorRepositoryInterface
    ) {
        $this->authorRepositoryInterface = $authorRepositoryInterface;
    }

    public function execute() {
        if (!in_array(auth()->user()->role, ['admin', 'author'])) {
            throw new UnauthorizedException('You do not have permission to view the authors');
        }
        return $this->authorRepositoryInterface->findAll();
    }
}
