<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Book",
 *     description="Book model",
 *     @OA\Property(property="id", type="integer", format="int64", example="1"),
 *     @OA\Property(property="title", type="string", example="Example Book"),
 *     @OA\Property(property="publisher", type="string", example="Example Publisher"),
 *     @OA\Property(property="author", type="string", example="Example Author"),
 *     @OA\Property(property="genre", type="string", example="Fantasy"),
 *     @OA\Property(property="publicationDate", type="string", format="date", example="2024-04-17"),
 *     @OA\Property(property="amountWords", type="integer", example="100000"),
 *     @OA\Property(property="price", type="number", format="float", example="19.99"),
 * )
 */
class Book extends Model
{
    use HasFactory;

    protected $table = 'book';

    protected $fillable = ['title', 'publisher', 'author', 'genre', 'publicationDate', 'amountWords', 'price'];
}
