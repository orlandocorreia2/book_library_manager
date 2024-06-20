<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\DeleteAuthorServiceInterface;
use App\Services\Api\Interfaces\FindOneAuthorServiceInterface;
use App\Services\Api\Interfaces\UpdateUserServiceInterface;
use App\Repositories\Api\Interfaces\AuthorRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;

class DeleteAuthorService implements DeleteAuthorServiceInterface
{
    private FindOneAuthorServiceInterface $findOneAuthorServiceInterface;
    private AuthorRepositoryInterface $authorRepositoryInterface;
    private UpdateUserServiceInterface $updateUserServiceInterface;

    public function __construct(
        FindOneAuthorServiceInterface $findOneAuthorServiceInterface,
        AuthorRepositoryInterface $authorRepositoryInterface,
        UpdateUserServiceInterface $updateUserServiceInterface
    ) {
        $this->findOneAuthorServiceInterface = $findOneAuthorServiceInterface;
        $this->authorRepositoryInterface = $authorRepositoryInterface;
        $this->updateUserServiceInterface = $updateUserServiceInterface;
    }

    public function execute(String $id) {
        $author = $this->findOneAuthorServiceInterface->execute($id);
        if (!$author) {
            throw new NotFoundException('Author not found');
        }
        if (!in_array($author->user->role, ['admin', 'author'])) {
            throw new UnauthorizedException('Unauthorized');
        }
        $this->authorRepositoryInterface->delete($id);
        if ($author->user->role == 'author') {
            $this->updateUserServiceInterface->execute($author->user->id, ['role' => 'user']);
        }
    }
}
