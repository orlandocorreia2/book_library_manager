<?php

namespace App\Services\Api\Interfaces;

use App\Models\Author;

interface FindOneAuthorServiceInterface
{
    public function execute(String $id): Author;
}
