<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        // Not found exception handler
        if($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => [
                    'description' => 'Invalid URI',
                    'messages' => $exception->getMessage()
                ]
            ], 404);
        }

        // Method not allowed exception handler
        if($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => [
                    'description' => 'Method Not Allowed',
                    'messages' => $exception->getMessage()
                ]
            ], 405);
        }

        // Method not allowed exception handler
        if($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => [
                    'description' => 'sai fora',
                    'messages' => []
                ]
            ], 402);
        }

        return parent::render($request, $exception);
    }
}
