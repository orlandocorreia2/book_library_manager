<?php

namespace App\Services\Api;

use Exception;
use App\Services\Api\Interfaces\CreateUserServiceInterface;
use App\Repositories\Api\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\SystemUnavailableException;
use App\Http\Requests\Api\CreateUserRequest;

class CreateUserService implements CreateUserServiceInterface {

    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(CreateUserRequest $request): Array {
        $user = $this->userRepositoryInterface->create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if (!$user) {
            throw new SystemUnavailableException('User cannot be created, please try again later');
        }
        return [
            'id' => $user->id,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];
    }
}
