<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\UpdateAuthorServiceInterface;
use App\Services\Api\Interfaces\FindOneUserServiceInterface;
use App\Repositories\Api\Interfaces\AuthorRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\SystemUnavailableException;
use App\Http\Requests\Api\UpdateAuthorRequest;

class UpdateAuthorService implements UpdateAuthorServiceInterface
{
    private FindOneUserServiceInterface $findOneUserServiceInterface;
    private AuthorRepositoryInterface $authorRepositoryInterface;

    public function __construct(
        FindOneUserServiceInterface $findOneUserServiceInterface,
        AuthorRepositoryInterface $authorRepositoryInterface
    ) {
        $this->findOneUserServiceInterface = $findOneUserServiceInterface;
        $this->authorRepositoryInterface = $authorRepositoryInterface;
    }

    public function execute(String $id, UpdateAuthorRequest $request) {
        $user = $this->findOneUserServiceInterface->execute($request->user_id);
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        if (!in_array($user->role, ['admin', 'author'])) {
            throw new UnauthorizedException('Unauthorized');
        }
        $this->authorRepositoryInterface->update($id, [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'birth_date' => date('Y-m-d', strtotime($request->birth_date))
        ]);
    }
}
