<?php

namespace App\Http\Controllers;

use App\Exceptions\ItemNotFoundException;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Http\Requests\AuthorQueryRequest;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(AuthorQueryRequest $request)
    {
        $queryString = $request->getQueryString();
        $cacheKey = 'authors_all_' . md5($queryString);
        $authors = Cache::remember($cacheKey, 90, function () use ($request) {
            return $this->authorRepository->all($request);
        });
        return new AuthorCollection($authors);
    }

    public function show($id)
    {
        $cacheKey = "author_{$id}";
        $author = Cache::remember($cacheKey, 90, function () use ($id) {
            $author = $this->authorRepository->find($id);
            $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));
            return $author;
        });

        return new AuthorResource($author);
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authorRepository->create($request->all());
        Cache::put("author_{$author->id}", $author, 90);
        return new AuthorResource($author);
    }

    public function update($id, AuthorRequest $request)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));
    
        $author = $this->authorRepository->update($id, $request->all());
        Cache::put("author_{$id}", $author, 90); 
        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));

        $this->authorRepository->delete($author);
        Cache::forget("author_{$id}");
        return response()->noContent();
    }
}
