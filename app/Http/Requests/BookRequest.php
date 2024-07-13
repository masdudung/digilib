<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|min:3|max:100',
                'author_id' => 'required|integer|exists:authors,id',
                'description' => 'nullable|string|max:255',
                'publish_date' => 'required|date',
            ];
        }

        if ($this->isMethod('patch')) {
            return [
                'title' => 'sometimes|string|min:3|max:100',
                'author_id' => 'sometimes|integer|exists:authors,id',
                'description' => 'nullable|string|max:255',
                'publish_date' => 'sometimes|date',
            ];
        }

        return [];
    }
}
