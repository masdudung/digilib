<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'message' => '',
            'data' => $this->collection->transform(function($book) {
                return [
                    'id' => $book->id,
                    'name' => $book->name,
                    'bio' => $book->bio,
                    'birthdate' => $book->birthdate,
                    'created_at' => $book->created_at,
                    'updated_at' => $book->updated_at,
                ];
            }),
        ];
    }
}
