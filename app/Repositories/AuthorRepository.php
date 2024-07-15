<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * Retrieve all authors with optional search, sort, and pagination.
     */
    public function all(Request $request): LengthAwarePaginator
    {
        $query = Author::select(['id', 'name', 'bio', 'birthdate']);

        // Apply search filter if provided
        if ($request->has('search')) {
            $searchTerm = $request->query('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply sorting if provided
        if ($request->has('sort') && $request->has('order')) {
            $sort = $request->query('sort');
            $order = $request->query('order');
            $query->orderBy($sort, $order);
        }

        // Set pagination limit, default to 10
        $limit = $request->query('limit', 10);
        
        return $query->paginate($limit);
    }

    /**
     * Find an author by ID.
     */
    public function find($id): ?Author
    {
        return Author::find($id) ?? null;
    }

    /**
     * Create a new author.
     */
    public function create(array $data): Author
    {
        return Author::create($data);
    }

    /**
     * Update an existing author.
     */
    public function update(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    /**
     * Delete an author.
     */
    public function delete(Author $author): bool
    {
        $author->delete();
        return true;
    }
}