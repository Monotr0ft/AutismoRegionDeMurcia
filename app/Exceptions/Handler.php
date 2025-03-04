<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Mockery\Generator\Method;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
    public function render($request, Throwable $exception)
    {
        // Si es una excepción de validación, redirige con errores
        if ($exception instanceof ValidationException) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        }

        // Si el modelo no existe (ej: findOrFail)
        if ($exception instanceof ModelNotFoundException) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'El registro solicitado no existe.']);
        }

        // Errores comunes en CRUD (operaciones fallidas)
        if ($exception instanceof \Exception || $exception instanceof HttpException) {
            $message = $exception->getMessage() ?: 'Ocurrió un error inesperado.';
            return redirect()
                ->back()
                ->withErrors(['error' => $message]);
        }

        // Si el método no está permitido, lanza una excepción 404
        if ($exception instanceof MethodNotAllowedHttpException) {
            throw new NotFoundHttpException();
        }

        return parent::render($request, $exception);
    }
}
