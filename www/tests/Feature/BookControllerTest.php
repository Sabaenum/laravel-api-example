<?php

namespace Tests\Feature;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_books(): void
    {
        $books = Book::factory()->count(3)->create();
        $response = $this->get(route('api.v1.books.index'));

        $response->assertStatus(200);
        $response->assertJsonFragment(BookResource::collection($books)->response()->getData(true));
    }

    public function test_get_book(): void
    {
        $books = Book::factory()->create();
        $response = $this->get(route('api.v1.books.show', $books->id));

        $response->assertStatus(200);
        $response->assertJsonFragment((new BookResource($books))->resolve());
    }

    public function test_add_book(): void
    {
        $books = Book::factory()->make();
        $data = $books->toArray();
        $response = $this->post(route('api.v1.books.store'),
            $data
        );
        $books->id = $response->json()['data']['id'];
        $response->assertStatus(201);
        $response->assertJsonFragment((new BookResource($books))->response()->getData(true));
    }

    public function test_update_book(): void
    {
        $books = Book::factory()->create();
        $books->title = 'Test Book';
        $data = $books->toArray();
        $response = $this->get(route('api.v1.books.update', $books->id),
            $data
        );
        $books->refresh();
        $response->assertStatus(200);
        $response->assertJsonFragment((new BookResource($books))->resolve());
    }

    public function test_delete_book(): void
    {
        $books = Book::factory()->create();
        $response = $this->get(route('api.v1.books.destroy', $books->id));

        $response->assertStatus(200);
    }
}
