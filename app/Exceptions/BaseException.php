<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/22
 * Time: 16:37
 */

namespace App\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    /**
     * 返回的http状态码
     * @var int
     */
    protected $code = 200;

    /**
     * 错误信息
     * @var string
     */
    protected $message = 'invalid parameters';

    /**
     * 自定义错误码
     * @var int
     */
    protected $errorCode = 999;

    /**
     * 附加数据
     * @var array
     */
    protected $data = [];

    /**
     * 允许携带的附加数据key
     * @var array
     */
    public $accessKey = [
        'data', 'errorCode', 'message'
    ];

    /**
     * BaseException constructor.
     * @param array $errorData
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $errorData = [], int $code = 0, Throwable $previous = null)
    {
        foreach ($this->accessKey as $key => $value) {
            if (array_key_exists($value, $errorData)) $this->$value = $errorData[$value];
        }

        if ($code) $this->code = $code;

        return parent::__construct($this->message, $this->code, $previous);
    }

    final public function getErrorCode()
    {
        return $this->errorCode;
    }

    final public function getErrorData()
    {
        return $this->data;
    }
}