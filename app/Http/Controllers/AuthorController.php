<?php

namespace App\Http\Controllers;

use App\Exceptions\ItemNotFoundException;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Http\Requests\AuthorQueryRequest;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;


class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(AuthorQueryRequest $request)
    {
        $authors = $this->authorRepository->all($request);
        return new AuthorCollection($authors);
    }

    public function show($id)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));

        return new AuthorResource($author);
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authorRepository->create($request->all());
        return new AuthorResource($author);
    }

    public function update($id, AuthorRequest $request)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));
    
        $author = $this->authorRepository->update($id, $request->all());
        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));

        $this->authorRepository->delete($author);
        return response()->noContent();
    }
}
