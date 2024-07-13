<?php

namespace App\Repositories\Interfaces;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface BookRepositoryInterface
{
    public function all(Request $request): LengthAwarePaginator;

    public function find($id): ?Book;

    public function create(array $data): Book;

    public function update(Book $book, array $data): Book;

    public function delete(Book $book): bool;
}