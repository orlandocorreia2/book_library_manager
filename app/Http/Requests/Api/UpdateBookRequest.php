<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'year_publication' => 'required|number',
        ];
    }
}
