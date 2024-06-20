<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Services\Api\Interfaces\CreateUserServiceInterface;
use App\Services\Api\Interfaces\FindAllUsersServiceInterface;
use App\Services\Api\Interfaces\FindOneUserServiceInterface;

class UserController extends Controller
{
    private CreateUserServiceInterface $createUserServiceInterface;
    private FindAllUsersServiceInterface $findAllUsersServiceInterface;
    private FindOneUserServiceInterface $findOneUserServiceInterface;

    public function __construct(
        CreateUserServiceInterface $createUserServiceInterface,
        FindAllUsersServiceInterface $findAllUsersServiceInterface,
        FindOneUserServiceInterface $findOneUserServiceInterface,
    ) {
        $this->createUserServiceInterface = $createUserServiceInterface;
        $this->findAllUsersServiceInterface = $findAllUsersServiceInterface;
        $this->findOneUserServiceInterface = $findOneUserServiceInterface;
    }

    public function index()
    {
        try {
            $users = $this->findAllUsersServiceInterface->execute();
            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $user = $this->createUserServiceInterface->execute($request);
            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->findOneUserServiceInterface->execute($id);
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
