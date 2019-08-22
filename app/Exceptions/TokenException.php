<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/22
 * Time: 17:05
 */

namespace App\Exceptions;


/**
 * 令牌错误
 * Class TokenException
 * @package App\Exceptions
 */
class TokenException extends BaseException
{
    protected $message = 'Token已过期';
    protected $code = 401;
    protected $errorCode = 10003;
}