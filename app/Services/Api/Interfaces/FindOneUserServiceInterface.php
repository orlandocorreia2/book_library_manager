<?php

namespace App\Services\Api\Interfaces;

use App\Models\User;

interface FindOneUserServiceInterface
{
    public function execute(String $id): User;
}
