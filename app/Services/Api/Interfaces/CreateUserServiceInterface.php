<?php

namespace App\Services\Api\Interfaces;

use App\Http\Requests\Api\CreateUserRequest;

interface CreateUserServiceInterface
{
    public function execute(CreateUserRequest $request): Array;
}
