<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display authenticated user's books
    public function index(Request $request): JsonResponse
    {
        $books = $request->user()
            ->books()
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Books retrieved successfully.',
            'data' => BookResource::collection($books->items())->resolve(),
            'meta' => [
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
                'per_page' => $books->perPage(),
                'total' => $books->total(),
            ],
            'links' => [
                'first' => $books->url(1),
                'last' => $books->url($books->lastPage()),
                'prev' => $books->previousPageUrl(),
                'next' => $books->nextPageUrl(),
            ],
        ]);
    }

    // Display a specific book
    public function show(Request $request, int $id): JsonResponse
    {
        $book = $request->user()->books()->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Book retrieved successfully.',
            'data' => (new BookResource($book))->resolve(),
        ]);
    }

    // Create a book
    public function store(StoreBookRequest $request): JsonResponse
    {
        if (!$request->user()->tokenCan('books:write')) {
            return response()->json([
                'success' => false,
                'message' => 'This token is read-only.',
            ], 403);
        }

        $book = $request->user()->books()->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully.',
            'data' => (new BookResource($book))->resolve(),
        ], 201);
    }

    // Update a book
    public function update(
        UpdateBookRequest $request,
        int $id
    ): JsonResponse {
        if (!$request->user()->tokenCan('books:write')) {
            return response()->json([
                'success' => false,
                'message' => 'This token is read-only.',
            ], 403);
        }

        $book = $request->user()->books()->findOrFail($id);

        $book->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully.',
            'data' => (new BookResource($book->fresh()))->resolve(),
        ]);
    }

    // Delete a book
    public function destroy(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->tokenCan('books:write')) {
            return response()->json([
                'success' => false,
                'message' => 'This token is read-only.',
            ], 403);
        }

        $book = $request->user()->books()->findOrFail($id);

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully.',
        ]);
    }
}
