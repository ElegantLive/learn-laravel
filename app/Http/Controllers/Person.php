<?php

namespace App\Http\Controllers;

use App\Exceptions\SuccessMessage;
use App\Http\Requests\PersonCreate;
use App\Http\Validate\PersonValidate;
use Illuminate\Http\Request;

class Person extends Controller
{
    /**
     * test for validate
     *
     * @param Request $request
     * @throws SuccessMessage
     * @throws \App\Exceptions\ParameterException
     */
    public function test(Request $request)
    {
        (new PersonValidate($request))->check();

        throw new SuccessMessage();
    }

    /**
     * test for validate
     *
     * @param PersonCreate $request
     * @throws SuccessMessage
     */
    public function tests(PersonCreate $request)
    {
        throw new SuccessMessage(['data' => $request->validated()]);
    }
}
