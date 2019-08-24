<?php

namespace App\Http\Requests;

use App\Exceptions\TokenException;
use App\Rules\Mobile;
use App\Rules\Password;
use App\Rules\SexType;
use Illuminate\Foundation\Http\FormRequest;

class PersonCreate extends FormRequest
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
}
