<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $levels = [];
    protected $dontReport = [];
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['status'=>false,'message'=>'Resource not found'], 404);
            }

            if ($exception instanceof ValidationException) {
                return response()->json(['status'=>false,'message'=>'Validation error','errors'=>$exception->errors()], 422);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json(['status'=>false,'message'=>'Unauthenticated'], 401);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['status'=>false,'message'=>'Endpoint not found'], 404);
            }

            return response()->json(['status'=>false,'message'=>$exception->getMessage() ?: 'Server Error'], 500);
        }

        return parent::render($request, $exception);
    }
}
