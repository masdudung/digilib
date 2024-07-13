<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class BookRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $BookRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->BookRepository = new BookRepository();
        DB::statement('PRAGMA foreign_keys = OFF;');
    }

    public function test_all_method_returns_paginated_books()
    {
        for ($i = 0; $i < 15; $i++) {
            Book::create([
                'title' => 'Book ' . $i,
                'author_id' => 1,
                'description' => 'Description ' . $i,
                'publish_date' => '2000-01-01',
            ]);
        }

        $request = Request::create('/books', 'GET', ['limit' => 10]);
        $result = $this->BookRepository->all($request);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);
        $this->assertCount(10, $result->items());
    }

    public function test_find_method_returns_book()
    {
        $book = Book::create([
            'title' => 'lala',
            'author_id' => 1,
            'description' => 'lalalala',
            'publish_date' => '2000-01-01',
        ]);

        $result = $this->BookRepository->find($book->id);

        $this->assertInstanceOf(Book::class, $result);
        $this->assertEquals($book->id, $result->id);
    }

    public function test_create_method_creates_book()
    {
        $data = [
            'title' => 'lala',
            'author_id' => 1,
            'description' => 'lalalala',
            'publish_date' => '2000-01-01',
        ];

        $result = $this->BookRepository->create($data);

        $this->assertInstanceOf(Book::class, $result);
        $this->assertDatabaseHas('books', $data);
    }

    public function test_update_method_updates_book()
    {
        $book = Book::create([
            'title' => 'lala',
            'author_id' => 1,
            'description' => 'lalalala',
            'publish_date' => '2000-01-01',
        ]);
        $data = ['title' => 'lili', 'description' => 'lililili'];

        $result = $this->BookRepository->update($book, $data);

        $this->assertInstanceOf(Book::class, $result);
        $this->assertEquals('lili', $result->title);
        $this->assertEquals('lililili', $result->description);
    }

    public function test_delete_method_deletes_book()
    {
        $book = Book::create([
            'title' => 'lala',
            'author_id' => 1,
            'description' => 'lalalala',
            'publish_date' => '2000-01-01',
        ]);

        $result = $this->BookRepository->delete($book);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}