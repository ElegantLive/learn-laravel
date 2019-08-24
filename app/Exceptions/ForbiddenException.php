<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/22
 * Time: 17:03
 */

namespace App\Exceptions;

/**
 * 无权访问错误
 * Class ForbiddenException
 * @package App\Exceptions
 */
class ForbiddenException extends BaseException
{
    protected $message = '权限不够';
    protected $status = 403;
    protected $errorCode = 10001;
}