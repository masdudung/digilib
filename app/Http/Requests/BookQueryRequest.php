<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookQueryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'sometimes|string',
            'sort' => 'sometimes|string|in:title,author_id,published_date',
            'order' => 'sometimes|string|in:asc,desc',
            'page' => 'sometimes|integer|min:1',
            'limit' => 'sometimes|integer|min:1|max:100',
        ];
    }
}