<?php

namespace App\Http\Controllers;

use App\Exceptions\ItemNotFoundException;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Http\Requests\AuthorQueryRequest;
use App\Http\Requests\AuthorRequest;


class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(AuthorQueryRequest $request)
    {
        return $this->authorRepository->all($request);
    }

    public function show($id)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));

        return $author;
    }

    public function store(AuthorRequest $request)
    {
        return $this->authorRepository->create($request->all());
    }

    public function update($id, AuthorRequest $request)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));
    
        return $this->authorRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        $author = $this->authorRepository->find($id);
        $author || throw new ItemNotFoundException(config('message.errors.author_not_found'));

        return $this->authorRepository->delete($id);
    }
}
