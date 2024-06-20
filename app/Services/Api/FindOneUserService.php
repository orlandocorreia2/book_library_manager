<?php

namespace App\Services\Api;

use App\Models\User;
use App\Services\Api\Interfaces\FindOneUserServiceInterface;
use App\Repositories\Api\Interfaces\UserRepositoryInterface;

class FindOneUserService implements FindOneUserServiceInterface {

    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(String $id): User {
        return $this->userRepositoryInterface->findOne($id);
    }
}
