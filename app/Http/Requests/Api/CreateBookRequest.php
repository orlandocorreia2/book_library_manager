<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'year_publication' => 'required|integer',
        ];
    }
}
