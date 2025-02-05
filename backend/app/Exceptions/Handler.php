<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render(Request $request, Throwable $e)
    {
        if ($request->expectsJson()) {
            return $this->handleApiException($e);
        }
    }

    /**
     * Handle API-specific exceptions
     */
    protected function handleApiException(Throwable $e): JsonResponse
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => 'error',
                'message' => 'The requested endpoint does not exist'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'status' => 'error',
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'status' => "error",
            'message' => $e->getMessage()
        ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
