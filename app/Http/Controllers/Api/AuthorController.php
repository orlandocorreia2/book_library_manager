<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateAuthorRequest;
use App\Http\Requests\Api\UpdateAuthorRequest;
use App\Services\Api\Interfaces\CreateAuthorServiceInterface;
use App\Services\Api\Interfaces\FindAllAuthorsServiceInterface;
use App\Services\Api\Interfaces\UpdateAuthorServiceInterface;
use App\Services\Api\Interfaces\DeleteAuthorServiceInterface;

class AuthorController extends Controller
{
    private CreateAuthorServiceInterface $createAuthorServiceInterface;
    private FindAllAuthorsServiceInterface $findAllAuthorsServiceInterface;
    private UpdateAuthorServiceInterface $updateAuthorServiceInterface;
    private DeleteAuthorServiceInterface $deleteAuthorServiceInterface;

    public function __construct(
        CreateAuthorServiceInterface $createAuthorServiceInterface,
        FindAllAuthorsServiceInterface $findAllAuthorsServiceInterface,
        UpdateAuthorServiceInterface $updateAuthorServiceInterface,
        DeleteAuthorServiceInterface $deleteAuthorServiceInterface,
    ) {
        $this->createAuthorServiceInterface = $createAuthorServiceInterface;
        $this->findAllAuthorsServiceInterface = $findAllAuthorsServiceInterface;
        $this->updateAuthorServiceInterface = $updateAuthorServiceInterface;
        $this->deleteAuthorServiceInterface = $deleteAuthorServiceInterface;
    }

    public function index()
    {
        try {
            $users = $this->findAllAuthorsServiceInterface->execute();
            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateAuthorRequest $request)
    {
        try {
            $author = $this->createAuthorServiceInterface->execute($request);
            return response()->json($author, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(String $id, UpdateAuthorRequest $request)
    {
        try {
            $this->updateAuthorServiceInterface->execute($id, $request);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        try {
            $this->deleteAuthorServiceInterface->execute($id);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
