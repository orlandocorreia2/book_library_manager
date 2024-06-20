<?php

namespace App\Services\Api\Interfaces;

interface UpdateUserServiceInterface
{
    public function execute(String $id, Array $data);
}
