
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;

// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Generate a separate read-only token
    Route::post('/read-only-token', function (\Illuminate\Http\Request $request) {
        $token = $request->user()->createToken(
            'reading-list-read-only',
            ['books:read']
        );

        return response()->json([
            'success' => true,
            'message' => 'Read-only token created successfully.',
            'data' => [
                'token' => $token->plainTextToken,
            ],
        ], 201);
    });

    // Book endpoints
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});
