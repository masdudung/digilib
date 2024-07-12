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
        $query = Author::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->query('search') . '%');
        }

        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->query('sort'), $request->query('order'));
        }

        $limit = $request->query('limit', 10);
        return $query->paginate($limit);
    }

    public function find($id): ?Author
    {
        return Author::findOrFail($id);
    }

    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function update($id, array $data): Author
    {
        $author = Author::findOrFail($id);
        $author->update($data);
        return $author;
    }

    public function delete($id): bool
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return true;
    }
}