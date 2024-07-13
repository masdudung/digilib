<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface
{
    public function all(Request $request): LengthAwarePaginator;
    public function find($id): ?Author;
    public function create(array $data): Author;
    public function update(Author $author, array $data): Author;
    public function delete(Author $author): bool;
}