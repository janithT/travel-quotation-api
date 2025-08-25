<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public static array $handlers = [
        NotFoundHttpException::class => 'handleNotFoundException',
        ValidationException::class => 'handleValidationException',
        MethodNotAllowedHttpException::class => 'handleMethodNotAllowedException',
        AuthenticationException::class => 'handleUnauthenticatedException',
    ];

    /**
     * Handle not found exceptions
     */
    public function handleNotFoundException(
        ModelNotFoundException|NotFoundHttpException $e,
        Request $request
    ): JsonResponse {

        $message = $e instanceof ModelNotFoundException
            ? 'The requested resource was not found.'
            : "The requested endpoint '{$request->getRequestUri()}' was not found.";

        return apiResponseWithStatusCode([], 'error', $message, '', 404);
    }

    /**
     * Handle not validation exceptions
     */
    public function handleValidationException(
        ValidationException $e,
        Request $request
    ): JsonResponse {
        $errors = [];

        foreach ($e->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message,
                ];
            }
        }
        return apiResponseWithStatusCode([], 'error', $errors, '', 422);
    }

    /**
     * Handle not unauthenticate exceptions
     */
    public function handleUnauthenticatedException(
        AuthenticationException $e,
        $request
    ): \Illuminate\Http\JsonResponse {
        $errors = [
            [
                'field'   => 'auth',
                'message' => $e->getMessage() ?: 'Unauthenticated.',
            ]
        ];

        return apiResponseWithStatusCode([], 'error', $errors, '', 401);
    }


    // get exception type
    private function __getExceptionType(Throwable $e): string
    {
        $className = basename(str_replace('\\', '/', get_class($e)));
        return $className;
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $errors = [
            [
                'field'   => 'auth',
                'message' => $exception->getMessage() ?: 'Unauthenticated.',
            ]
        ];

        return apiResponseWithStatusCode([], 'error', $errors, '', 401);
    }
}
