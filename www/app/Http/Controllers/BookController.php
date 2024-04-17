<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     summary="Get all books",
     *     description="Retrieve a list of all books",
     *     tags={"Books"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Book"),
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/books",
     *     summary="Store a new book",
     *     description="Creates a new book record in the database",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Book"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example="{'title': ['The title field is required.']}"),
     *         ),
     *     ),
     * )
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return new BookResource($book);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/books/{book}",
     *     summary="Get a specific book",
     *     description="Retrieve information about a specific book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         description="ID of the book to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book"),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Book not found."),
     *         ),
     *     ),
     * )
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * @OA\Patch(
     *     path="/api/v1/books/{book}",
     *     summary="Update a book",
     *     description="Update the specified book in the database",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         description="ID of the book to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="title", type="string", example="Example Book"),
     *          @OA\Property(property="publisher", type="string", example="Example Publisher"),
     *          @OA\Property(property="author", type="string", example="Example Author"),
     *          @OA\Property(property="genre", type="string", example="Fantasy"),
     *          @OA\Property(property="publicationDate", type="string", format="date", example="2024-04-17"),
     *          @OA\Property(property="amountWords", type="integer", example="100000"),
     *          @OA\Property(property="price", type="number", format="float", example="19.99"),
     *        ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example="{'title': ['The title field is required.']}"),
     *         ),
     *     ),
     * )
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        $book->update($request->validated());

        return new BookResource($book);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/books/{book}",
     *     summary="Delete a book",
     *     description="Delete a specific book from the database",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         description="ID of the book to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Book not found."),
     *         ),
     *     ),
     * )
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
