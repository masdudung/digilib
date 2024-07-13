<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BookRepository implements BookRepositoryInterface
{
    /**
     * Retrieve all books with optional search, sort, and pagination.
     */
    public function all(Request $request): LengthAwarePaginator
    {
        $query = Book::select(['id', 'title', 'author_id', 'publish_date'])
                     ->with('author:id,name,birthdate');

        // Apply search filter if provided
        if ($request->has('search')) {
            $searchTerm = $request->query('search');
            $query->where('title', 'like', '%' . $searchTerm . '%');
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
     * Find a book by ID.
     */
    public function find($id): ?Book
    {
        return Book::with('author:id,name,birthdate')->find($id) ?? null;
    }

    /**
     * Create a new book.
     */
    public function create(array $data): Book
    {
        $book = Book::create($data);
        $book->load('author:id,name,birthdate');
        return $book;
    }

    /**
     * Update an existing book.
     */
    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        $book->load('author:id,name,birthdate');
        return $book;
    }

    /**
     * Delete a book.
     */
    public function delete(Book $book): bool
    {
        $book->delete();
        return true;
    }
}