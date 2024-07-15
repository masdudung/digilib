<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => '',
            'data' => [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'publish_date' => $this->publish_date,
                'author' => [
                    'id' => $this->author->id,
                    'name' => $this->author->name,
                    'bio' => $this->author->bio,
                    'birthdate' => $this->author->birthdate,
                ],
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}