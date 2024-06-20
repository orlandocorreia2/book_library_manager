<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\CreateAuthorServiceInterface;
use App\Services\Api\Interfaces\FindOneUserServiceInterface;
use App\Services\Api\Interfaces\UpdateUserServiceInterface;
use App\Repositories\Api\Interfaces\AuthorRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\SystemUnavailableException;
use App\Http\Requests\Api\CreateAuthorRequest;

class CreateAuthorService implements CreateAuthorServiceInterface
{
    private FindOneUserServiceInterface $findOneUserServiceInterface;
    private UpdateUserServiceInterface $updateUserServiceInterface;
    private AuthorRepositoryInterface $authorRepositoryInterface;

    public function __construct(
        FindOneUserServiceInterface $findOneUserServiceInterface,
        UpdateUserServiceInterface $updateUserServiceInterface,
        AuthorRepositoryInterface $authorRepositoryInterface
    ) {
        $this->findOneUserServiceInterface = $findOneUserServiceInterface;
        $this->updateUserServiceInterface = $updateUserServiceInterface;
        $this->authorRepositoryInterface = $authorRepositoryInterface;
    }

    public function execute(CreateAuthorRequest $request): Array {
        $user = $this->findOneUserServiceInterface->execute($request->user_id);
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        if (!in_array($user->role, ['admin', 'author'])) {
            throw new UnauthorizedException('Unauthorized');
        }
        $author = $this->authorRepositoryInterface->create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'birth_date' => date('Y-m-d', strtotime($request->birth_date))
        ]);
        if (!$author) {
            throw new SystemUnavailableException('Author cannot be created, please try again later');
        }
        if ($user->role == 'user') {
            $this->updateUserServiceInterface->execute($user->id, ['role' => 'author']);
        }
        return [
            'id' => $author->id,
            'name' => $author->name,
            'birth_date' => $author->birth_date,
            'created_at' => $author->created_at,
            'updated_at' => $author->updated_at
        ];
    }
}
