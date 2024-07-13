<?php

namespace App\Http\Controllers;

use App\Exceptions\ItemNotFoundException;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Http\Requests\BookQueryRequest;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        // Inject the BookRepositoryInterface dependency
        $this->bookRepository = $bookRepository;
    }

    public function index(BookQueryRequest $request)
    {
        // Set default pagination values
        $request->mergeIfMissing([
            'page' => 1,
            'limit' => 10,
        ]);

        // Generate a cache key based on the query string
        $queryString = $request->getQueryString();
        $cacheKey = 'books_all_' . md5($queryString);

        // Retrieve books from cache or fetch from repository if not cached
        $books = Cache::remember($cacheKey, 90, function () use ($request) {
            return $this->bookRepository->all($request);
        });

        // Return the books as a collection
        return new BookCollection($books);
    }

    public function show($id)
    {
        // Generate a cache key for the book
        $cacheKey = "book_{$id}";

        // Retrieve book from cache or fetch from repository if not cached
        $book = Cache::remember($cacheKey, 90, function () use ($id) {
            $book = $this->bookRepository->find($id);
            $book || throw new ItemNotFoundException(config('message.errors.book_not_found'));
            return $book;
        });

        // Return the book as a resource
        return new BookResource($book);
    }

    public function store(BookRequest $request)
    {
        // Create a new book
        $book = $this->bookRepository->create($request->all());

        // Cache the newly created book
        Cache::put("book_{$book->id}", $book, 90);

        // Return the newly created book as a resource
        return new BookResource($book);
    }

    public function update($id, BookRequest $request)
    {
        // Find the book by ID, throw an exception if not found
        $book = $this->bookRepository->find($id);
        $book || throw new ItemNotFoundException(config('message.errors.book_not_found'));

        // Update the book with the new data
        $book = $this->bookRepository->update($book, $request->all());

        // Cache the updated book
        Cache::put("book_{$id}", $book, 90);

        // Return the updated book as a resource
        return new BookResource($book);
    }

    public function destroy($id)
    {
        // Find the book by ID, throw an exception if not found
        $book = $this->bookRepository->find($id);
        $book || throw new ItemNotFoundException(config('message.errors.book_not_found'));

        // Delete the book
        $this->bookRepository->delete($book);

        // Remove the book from cache
        Cache::forget("book_{$id}");

        // Return a no content response
        return response()->noContent();
    }
}