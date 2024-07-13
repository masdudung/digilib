<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BookRepository implements BookRepositoryInterface
{
    public function all(Request $request): LengthAwarePaginator
    {
        $query = Book::select(['id', 'title', 'author_id', 'publish_date'])
                     ->with('author:id,name,birthdate');

        if ($request->has('search')) {
            $searchTerm = $request->query('search');
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        if ($request->has('sort') && $request->has('order')) {
            $sort = $request->query('sort');
            $order = $request->query('order');
            $query->orderBy($sort, $order);
        }

        $limit = $request->query('limit', 10);
        
        return $query->paginate($limit);
    }

    public function find($id): ?Book
    {
        return Book::with('author:id,name,birthdate')->find($id) ?? null;
    }

    public function create(array $data): Book
    {
        $book = Book::create($data);
        $book->load('author:id,name,birthdate');
        return $book;
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        $book->load('author:id,name,birthdate');
        return $book;
    }

    public function delete(Book $book): bool
    {
        $book->delete();
        return true;
    }
}