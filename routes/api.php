<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;

// SignUp
Route::post('users', [UserController::class, 'store']);

// Routes Protected
Route::group(['middleware' => ['apiJwt']], function() {
    // Users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    // Authors
    Route::post('authors', [AuthorController::class, 'store']);
    Route::get('authors', [AuthorController::class, 'index']);
    Route::patch('authors/{id}', [AuthorController::class, 'update']);
    Route::delete('authors/{id}', [AuthorController::class, 'destroy']);
    // Books
    Route::post('books', [BookController::class, 'store']);
    Route::get('books', [BookController::class, 'index']);
    Route::patch('books/{id}', [BookController::class, 'update']);
    Route::delete('books/{id}', [BookController::class, 'destroy']);
});

// Auth
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
});
