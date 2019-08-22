<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/22
 * Time: 17:46
 */

namespace App\Exceptions;

use Exception;

class ExceptionHandler extends Handler
{
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

        if ($exception instanceof BaseException) {
            $defaultJson['errorCode'] = $exception->getErrorCode();
            $defaultJson['message'] = $exception->getMessage();
            $defaultJson['data'] = $exception->getErrorData();
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return Response::json($defaultJson, 500);
    }
}