<?php

namespace App\Services\Api\Interfaces;

use App\Http\Requests\Api\UpdateBookRequest;

interface UpdateBookServiceInterface
{
    public function execute(String $id, UpdateBookRequest $request);
}
