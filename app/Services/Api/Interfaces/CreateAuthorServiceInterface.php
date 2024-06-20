<?php

namespace App\Services\Api\Interfaces;

use App\Http\Requests\Api\CreateAuthorRequest;

interface CreateAuthorServiceInterface
{
    public function execute(CreateAuthorRequest $request): Array;
}
