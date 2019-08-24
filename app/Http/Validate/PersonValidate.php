<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/24
 * Time: 14:16
 */

namespace App\Http\Validate;


use App\Rules\Mobile;
use App\Rules\Password;
use App\Rules\SexType;

class PersonValidate extends BaseValidate
{
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:people'],
            'sex' => ['required', new SexType()],
            'mobile' => ['required', 'numeric', new Mobile(), 'unique:people'],
            'email' => ['required', 'string', 'email', 'unique:people'],
            'real_name' => ['required', 'string', 'nullable'],
            'password' => ['required', 'string', new Password()],
            'confirm_password' => ['required', 'string', 'same:password']
        ];
    }

    protected function messages()
    {
        return [
            'name' => '请输入姓名',
            'sex' => (new SexType())->message(),
            'mobile' => (new Mobile())->message(),
            'email' => '请输入正确的邮箱地址',
            'real_name' => '请输入真实姓名',
            'password' => (new Password())->message(),
            'confirm_password' => '密码不一致'
        ];
    }
}