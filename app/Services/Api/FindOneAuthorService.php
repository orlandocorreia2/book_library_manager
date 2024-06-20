<?php

namespace App\Services\Api;

use App\Models\Author;
use App\Services\Api\Interfaces\FindOneAuthorServiceInterface;
use App\Repositories\Api\Interfaces\AuthorRepositoryInterface;

class FindOneAuthorService implements FindOneAuthorServiceInterface {

    private AuthorRepositoryInterface $authorRepositoryInterface;

    public function __construct(
        AuthorRepositoryInterface $authorRepositoryInterface
    ) {
        $this->authorRepositoryInterface = $authorRepositoryInterface;
    }

    public function execute(String $id): Author {
        return $this->authorRepositoryInterface->findOne($id);
    }
}
