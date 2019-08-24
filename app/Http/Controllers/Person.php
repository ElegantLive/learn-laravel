<?php

namespace App\Http\Controllers;

use App\Exceptions\SuccessMessage;
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
    public function create(Request $request)
    {
        (new PersonValidate($request))->check();

        throw new SuccessMessage();
    }
}
