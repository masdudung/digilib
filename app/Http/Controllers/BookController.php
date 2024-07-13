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
        $this->bookRepository = $bookRepository;
    }

    public function index(BookQueryRequest $request)
    {
        $request->mergeIfMissing([
            'page' => 1,
            'limit' => 10,
        ]);

        $queryString = $request->getQueryString();
        $cacheKey = 'books_all_' . md5($queryString);
        $books = Cache::remember($cacheKey, 90, function () use ($request) {
            return $this->bookRepository->all($request);
        });
        return new BookCollection($books);
    }

    public function show($id)
    {
        $cacheKey = "book_{$id}";
        $book = Cache::remember($cacheKey, 90, function () use ($id) {
            $book = $this->bookRepository->find($id);
            $book || throw new ItemNotFoundException(config('message.errors.book_not_found'));
            return $book;
        });

        return new BookResource($book);
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookRepository->create($request->all());
        Cache::put("book_{$book->id}", $book, 90);
        return new BookResource($book);
    }

    public function update($id, BookRequest $request)
    {
        $book = $this->bookRepository->find($id);
        $book || throw new ItemNotFoundException(config('message.errors.book_not_found'));

        $book = $this->bookRepository->update($book, $request->all());
        Cache::put("book_{$id}", $book, 90);
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $book = $this->bookRepository->find($id);
        $book || throw new ItemNotFoundException(config('message.errors.book_not_found'));

        $this->bookRepository->delete($book);
        Cache::forget("book_{$id}");
        return response()->noContent();
    }
}