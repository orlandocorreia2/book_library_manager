<?php

namespace App\Services\Api\Interfaces;

use App\Models\Book;

interface FindOneBookServiceInterface
{
    public function execute(String $id): Book;
}
