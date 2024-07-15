<?php

namespace App\Exceptions;

use App\Http\Responders\Responder;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            //
        });
    }

    // Для возвращения ошибки 404 not found в виде json
    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException and $request->expectsJson()) {
            return (new Responder())->error(__("Route not found"), [
                __("404 not found")
            ], [], 404);
        }
        return parent::render($request, $e);
    }
}
