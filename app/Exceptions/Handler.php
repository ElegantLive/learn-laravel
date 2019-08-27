<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $statusCode = 500;
    protected $errorCode = 999;
    protected $message = '服务器异常';
    protected $data = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (empty($exception instanceof BaseException)) {
            parent::report($exception);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            $this->message = $exception->errors()[key($exception->errors())][0];
            $this->errorCode = (new ParameterException())->getErrorCode();
            $this->data = $exception->errors();
            $this->statusCode = $exception->status;

            return $this->prepareResponseJson($request);
        }

        if ($exception instanceof BaseException) {
            $this->errorCode = $exception->getErrorCode();
            $this->message = $exception->getMessage();
            $this->data = $exception->getErrorData();
            $this->statusCode = $exception->getStatus();

            return $this->prepareResponseJson($request);
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof HttpException) {
            $this->message = $exception->getMessage();
            $this->statusCode = $exception->getStatusCode();

            return $this->prepareResponseJson($request);
        }

        return $this->prepareResponseJson($request);
    }

    /**
     * Prepare return json response
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareResponseJson(Request $request)
    {
        return Response::json([
            'message' => $this->message,
            'data' => $this->data,
            'errorCode' => $this->errorCode,
            'requestUrl' => $request->path()
        ], $this->statusCode);
    }
}
