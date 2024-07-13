<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function all(Request $request): LengthAwarePaginator
    {
        $query = Author::select(['id', 'name', 'birthdate']);

        if ($request->has('search')) {
            $searchTerm = $request->query('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        if ($request->has('sort') && $request->has('order')) {
            $sort = $request->query('sort');
            $order = $request->query('order');
            $query->orderBy($sort, $order);
        }

        $limit = $request->query('limit', 10);
        
        return $query->paginate($limit);
    }

    public function find($id): ?Author
    {
        return Author::find($id) ?? null;
    }

    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function update(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    public function delete(Author $author): bool
    {
        $author->delete();
        return true;
    }
}