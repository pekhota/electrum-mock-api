<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @return array|\Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof NotFoundHttpException ) {
            return $this->errorResponse($request, $exception);
        }

        if($exception instanceof ValidationException) {
            return $this->validationErrorResponse($request, $exception, -32600);
        }
        return parent::render($request, $exception);
    }

    /**
     * @param \Illuminate\Http\Request $req
     * @param Exception $exception
     * @return array
     */
    private function errorResponse($req, Exception $exception, $code = null) {
        return [
            'id' => $req->input('id'),
            "jsonrpc" => "2.0",
            'error' => [
                'code' => empty($code) ? $exception->getCode() : $code,
                'message' => $exception->getMessage()
            ]
        ];
    }

    /**
     * @param \Illuminate\Http\Request $req
     * @param Exception $exception
     * @return array
     */
    private function validationErrorResponse($req, ValidationException $exception, $code = null) {
        $errors = $exception->errors();


        return [
            'id' => $req->input('id'),
            "jsonrpc" => "2.0",
            'error' => [
                'code' => empty($code) ? $exception->getCode() : $code,
                'message' => $exception->errors()[array_keys($errors)[0]][0]
            ]
        ];
    }
}
