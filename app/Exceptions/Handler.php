<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
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

    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        $statusCode = $response->getStatusCode();

        if ($statusCode === 403 || in_array($statusCode, [500, 503, 404])) {
            return Inertia::render('ErrorPage', ['status' => $statusCode])
                ->toResponse($request)
                ->setStatusCode($statusCode);
        } elseif ($statusCode === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        return $response;
    }
}
