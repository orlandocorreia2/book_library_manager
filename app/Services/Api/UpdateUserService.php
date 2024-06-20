<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\UpdateUserServiceInterface;
use App\Repositories\Api\Interfaces\UserRepositoryInterface;

class UpdateUserService implements UpdateUserServiceInterface {

    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(String $id, Array $data) {
        return $this->userRepositoryInterface->update($id, $data);
    }
}
