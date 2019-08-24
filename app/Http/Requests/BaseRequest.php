<?php

namespace App\Http\Requests;

use App\Exceptions\TokenException;
use App\Exceptions\ParameterException;
use App\Rules\Mobile;
use App\Rules\Password;
use App\Rules\SexType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name' => '',
            'sex' => ['required', new SexType()],
            'mobile' => ['required', 'numeric', new Mobile(), 'unique:people'],
            'email' => ['required', 'string', 'email', 'unique:people'],
            'real_name' => ['required', 'string', 'nullable'],
            'password' => ['required', 'string', new Password()],
            'confirm_password' => ['required', 'string', 'same:password']
        ];
    }

    /**
     * 自动验证
     * @param Request $request
     * @throws ParameterException
     */
    public function goCheck(Request $request)
    {
        $validator = Validator::make($request->all(), self::rules());

        throw new TokenException();

        $validator->after(function ($validator) {
            if ($validator->fails()) {
                throw new ParameterException(['data' => $validator->errors()]);
            }
        });
    }
}
