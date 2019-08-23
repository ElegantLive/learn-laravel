<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/23
 * Time: 13:51
 */

namespace App\Exceptions;


/**
 * 正常返回
 * Class SuccessMessage
 * @package App\Exceptions
 */
class SuccessMessage extends BaseException
{
    protected $code = 200;
    protected $message = 'OK';
    protected $errorCode = 0;
}