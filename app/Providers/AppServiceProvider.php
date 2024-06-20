<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Users
        $this->app->bind('App\Repositories\Api\Interfaces\UserRepositoryInterface', 'App\Repositories\Api\UserRepository');
        $this->app->bind('App\Services\Api\Interfaces\CreateUserServiceInterface', 'App\Services\Api\CreateUserService');
        $this->app->bind('App\Services\Api\Interfaces\FindAllUsersServiceInterface', 'App\Services\Api\FindAllUsersService');
        $this->app->bind('App\Services\Api\Interfaces\FindOneUserServiceInterface', 'App\Services\Api\FindOneUserService');
        $this->app->bind('App\Services\Api\Interfaces\UpdateUserServiceInterface', 'App\Services\Api\UpdateUserService');
        // Authors
        $this->app->bind('App\Repositories\Api\Interfaces\AuthorRepositoryInterface', 'App\Repositories\Api\AuthorRepository');
        $this->app->bind('App\Services\Api\Interfaces\CreateAuthorServiceInterface', 'App\Services\Api\CreateAuthorService');
        $this->app->bind('App\Services\Api\Interfaces\FindAllAuthorsServiceInterface', 'App\Services\Api\FindAllAuthorsService');
        $this->app->bind('App\Services\Api\Interfaces\FindOneAuthorServiceInterface', 'App\Services\Api\FindOneAuthorService');
        $this->app->bind('App\Services\Api\Interfaces\UpdateAuthorServiceInterface', 'App\Services\Api\UpdateAuthorService');
        $this->app->bind('App\Services\Api\Interfaces\DeleteAuthorServiceInterface', 'App\Services\Api\DeleteAuthorService');
        // Books
        $this->app->bind('App\Repositories\Api\Interfaces\BookRepositoryInterface', 'App\Repositories\Api\BookRepository');
        $this->app->bind('App\Services\Api\Interfaces\CreateBookServiceInterface', 'App\Services\Api\CreateBookService');
        $this->app->bind('App\Services\Api\Interfaces\FindAllBooksServiceInterface', 'App\Services\Api\FindAllBooksService');
        $this->app->bind('App\Services\Api\Interfaces\FindOneBookServiceInterface', 'App\Services\Api\FindOneBookService');
        $this->app->bind('App\Services\Api\Interfaces\UpdateBookServiceInterface', 'App\Services\Api\UpdateBookService');
        $this->app->bind('App\Services\Api\Interfaces\DeleteBookServiceInterface', 'App\Services\Api\DeleteBookService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
