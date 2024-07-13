<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $authorRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authorRepository = new AuthorRepository();
    }

    public function test_all_method_returns_paginated_authors()
    {
        for ($i = 0; $i < 15; $i++) {
            Author::create([
                'name' => 'Author ' . $i,
                'birthdate' => '1980-01-01',
            ]);
        }

        $request = Request::create('/authors', 'GET', ['limit' => 10]);
        $result = $this->authorRepository->all($request);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);
        $this->assertCount(10, $result->items());
    }

    public function test_find_method_returns_author()
    {
        $author = Author::create([
            'name' => 'lala',
            'birthdate' => '1980-01-01',
        ]);

        $result = $this->authorRepository->find($author->id);

        $this->assertInstanceOf(Author::class, $result);
        $this->assertEquals($author->id, $result->id);
    }

    public function test_create_method_creates_author()
    {
        $data = [
            'name' => 'lala',
            'birthdate' => '1980-01-01',
        ];

        $result = $this->authorRepository->create($data);

        $this->assertInstanceOf(Author::class, $result);
        $this->assertDatabaseHas('authors', $data);
    }

    public function test_update_method_updates_author()
    {
        $author = Author::create([
            'name' => 'lala',
            'birthdate' => '1980-01-01',
        ]);
        $data = ['name' => 'lili'];

        $result = $this->authorRepository->update($author, $data);

        $this->assertInstanceOf(Author::class, $result);
        $this->assertEquals('lili', $result->name);
    }

    public function test_delete_method_deletes_author()
    {
        $author = Author::create([
            'name' => 'John Doe',
            'birthdate' => '1980-01-01',
        ]);

        $result = $this->authorRepository->delete($author);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}