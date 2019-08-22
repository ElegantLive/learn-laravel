<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/22
 * Time: 16:59
 */

namespace App\Exceptions;


/**
 * 通用参数错误
 * Class ParameterException
 * @package App\Exceptions
 */
class ParameterException extends BaseException
{
    protected $code = 400;
    protected $errorCode = 10000;
    protected $message = "参数错误";
}