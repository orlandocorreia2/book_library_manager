<?php

namespace App\Services\Api;

use App\Services\Api\Interfaces\FindAllUsersServiceInterface;
use App\Repositories\Api\Interfaces\UserRepositoryInterface;

class FindAllUsersService implements FindAllUsersServiceInterface {

    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute() {
        return $this->userRepositoryInterface->findAll();
    }
}
