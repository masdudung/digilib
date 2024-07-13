<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
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
                    'title' => $book->title,
                    'description' => $book->description,
                    'publish_date' => $book->publish_date,
                    'author' => [
                        'id' => $book->author->id,
                        'name' => $book->author->name,
                        'email' => $book->author->email,
                    ],
                    'created_at' => $book->created_at,
                    'updated_at' => $book->updated_at,
                ];
            }),
        ];
    }
}