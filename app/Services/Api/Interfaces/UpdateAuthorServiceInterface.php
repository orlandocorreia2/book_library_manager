<?php

namespace App\Services\Api\Interfaces;

use App\Http\Requests\Api\UpdateAuthorRequest;

interface UpdateAuthorServiceInterface
{
    public function execute(String $id, UpdateAuthorRequest $request);
}
