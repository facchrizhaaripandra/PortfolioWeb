<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Log database connection errors but don't crash
            if ($e instanceof QueryException) {
                Log::warning('Database query error: ' . $e->getMessage());
            }
        });

        $this->renderable(function (Throwable $e, $request) {
            // Handle database connection errors gracefully
            if ($e instanceof QueryException || str_contains($e->getMessage(), 'database')) {
                Log::error('Database error handled gracefully: ' . $e->getMessage());

                // Return a fallback response instead of 500 error
                if ($request->is('api/*')) {
                    return response()->json([
                        'error' => 'Service temporarily unavailable',
                        'message' => 'Please try again later'
                    ], 503);
                }

                // For web routes, redirect to home with error message
                return redirect('/')->with('error', 'Service temporarily unavailable. Please try again later.');
            }

            // Handle model not found errors
            if ($e instanceof ModelNotFoundException) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'error' => 'Resource not found'
                    ], 404);
                }

                return response()->view('errors.404', [], 404);
            }

            // Handle general HTTP exceptions
            if ($e instanceof HttpException) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'error' => 'Request error',
                        'message' => $e->getMessage()
                    ], $e->getStatusCode());
                }
            }
        });
    }
}
