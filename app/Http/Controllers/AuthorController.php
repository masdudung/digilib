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
        // Inject the AuthorRepositoryInterface dependency, AppServiceProvider
        $this->authorRepository = $authorRepository;
    }

    public function index(AuthorQueryRequest $request)
    {
        // Set default pagination values
        $request->mergeIfMissing([
            'page' => 1,
            'limit' => 10,
        ]);
        
        // Generate a cache key based on the query string
        $queryString = $request->getQueryString();
        $cacheKey = 'authors_all_' . md5($queryString);
        
        // Retrieve authors from cache or fetch from repository if not cached
        $authors = Cache::remember($cacheKey, 90, function () use ($request) {
            return $this->authorRepository->all($request);
        });
        
        // Return the authors as a collection
        return new AuthorCollection($authors);
    }

    public function show($id)
    {
        // Generate a cache key for the author
        $cacheKey = "author_{$id}";
        
        // Retrieve author from cache or fetch from repository if not cached
        $author = Cache::remember($cacheKey, 90, function () use ($id) {
            $author = $this->authorRepository->find($id);
            $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));
            return $author;
        });

        // Return the author as a resource
        return new AuthorResource($author);
    }

    public function store(AuthorRequest $request)
    {
        // Create a new author
        $author = $this->authorRepository->create($request->all());
        
        // Cache the newly created author
        Cache::put("author_{$author->id}", $author, 90);
        
        // Return the newly created author as a resource
        return new AuthorResource($author);
    }

    public function update($id, AuthorRequest $request)
    {
        // Find the author by ID
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));
    
        // Update the author with the new data
        $author = $this->authorRepository->update($id, $request->all());
        
        // Cache the updated author
        Cache::put("author_{$id}", $author, 90); 
        
        // Return the updated author as a resource
        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        // Find the author by ID, throw an exception if not found
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));

        // Delete the author
        $this->authorRepository->delete($author);
        
        // Remove the author from cache
        Cache::forget("author_{$id}");
        
        // Return a no content response
        return response()->noContent();
    }
}
