<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/24
 * Time: 14:10
 */

namespace App\Http\Validate;


use App\Exceptions\ParameterException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseValidate
{
    protected $rules = [];
    protected $messages = [];
    protected $data = [];
    protected $errors = [];
    protected $message = '';

    /**
     * 自动校验
     * BaseValidate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->rules = static::rules();
        $this->messages = static::messages();
        $this->data = $request->all();
    }

    /**
     * 设置错误约束
     * @return array
     */
    protected function rules()
    {
        return [];
    }

    /**
     * 设置错误提示信息
     * @return array
     */
    protected function messages()
    {
        return [];
    }

    /**
     * 校验函数
     * @throws ParameterException
     */
    public function check()
    {
        $validator = Validator::make($this->data, $this->rules, $this->messages);

        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            $this->message = $validator->errors()->first(key($this->errors));
            throw new ParameterException([
                'data' => $this->errors,
                'message' => $this->message
            ]);
        }

        return $validator->validate();
    }
}