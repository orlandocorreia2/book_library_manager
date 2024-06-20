<?php

namespace App\Services\Api\Interfaces;

use App\Http\Requests\Api\CreateBookRequest;

interface CreateBookServiceInterface
{
    public function execute(CreateBookRequest $request): Array;
}
