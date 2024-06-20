<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateBookRequest;
use App\Services\Api\Interfaces\CreateBookServiceInterface;
use App\Services\Api\Interfaces\FindAllBooksServiceInterface;
use App\Services\Api\Interfaces\UpdateBookServiceInterface;
use App\Services\Api\Interfaces\DeleteBookServiceInterface;

class BookController extends Controller
{
    private CreateBookServiceInterface $createBookServiceInterface;
    private FindAllBooksServiceInterface $findAllBooksServiceInterface;
    private UpdateBookServiceInterface $updateBookServiceInterface;
    private DeleteBookServiceInterface $deleteBookServiceInterface;

    public function __construct(
        CreateBookServiceInterface $createBookServiceInterface,
        FindAllBooksServiceInterface $findAllBooksServiceInterface,
        UpdateBookServiceInterface $updateBookServiceInterface,
        DeleteBookServiceInterface $deleteBookServiceInterface,
    ) {
        $this->createBookServiceInterface = $createBookServiceInterface;
        $this->findAllBooksServiceInterface = $findAllBooksServiceInterface;
        $this->updateBookServiceInterface = $updateBookServiceInterface;
        $this->deleteBookServiceInterface = $deleteBookServiceInterface;
    }

    public function index()
    {
        try {
            $users = $this->findAllBooksServiceInterface->execute();
            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateBookRequest $request)
    {
        try {
            $book = $this->createBookServiceInterface->execute($request);
            return response()->json($book, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(String $id, UpdateAuthorRequest $request)
    {
        try {
            $this->updateBookServiceInterface->execute($id, $request);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        try {
            $this->deleteBookServiceInterface->execute($id);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
