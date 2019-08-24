<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/23
 * Time: 14:04
 */

namespace App\Exceptions;


/**
 * 资源找不到错误
 * Class MissException
 * @package App\Exceptions
 */
class MissException extends BaseException
{
    protected $status = 404;
    protected $errorCode = 998;
    protected $message = 'Missing data';
}