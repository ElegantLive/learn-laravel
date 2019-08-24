<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Response;

class Handler extends ExceptionHandler
{
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
        $defaultJson = [
            'errorCode' => 999,
            'message' => '服务器异常',
            'data' => [],
            'requestUrl' => $request->path()
        ];

        if ($exception instanceof ValidationException) {
            $defaultJson['errorCode'] = (new ParameterException())->getErrorCode();
            $defaultJson['message'] = $exception->getMessage();
            $defaultJson['data'] = $exception->errors();

            return Response::json($defaultJson, $exception->status);
        }

        if ($exception instanceof BaseException) {
            $defaultJson['errorCode'] = $exception->getErrorCode();
            $defaultJson['message'] = $exception->getMessage();
            $defaultJson['data'] = $exception->getErrorData();

            return Response::json($defaultJson, $exception->getCode());
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return Response::json($defaultJson, 500);
    }
}
