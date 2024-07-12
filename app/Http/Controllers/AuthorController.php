<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(Request $request)
    {
        return $this->authorRepository->all($request);
    }

    public function show($id)
    {
        return $this->authorRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->authorRepository->create($request->all());
    }

    public function update($id, Request $request)
    {
        return $this->authorRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->authorRepository->delete($id);
    }
}
