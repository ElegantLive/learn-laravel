<?php

namespace App\Http\Controllers;

use App\Exceptions\MissException;
use App\Exceptions\ParameterException;
use App\Exceptions\SuccessMessage;
use App\Http\Requests\PersonCreate;
use App\Http\Validate\PersonValidate;
use Illuminate\Http\Request;
use App\Model\Person as PersonModel;

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

    /**
     * 用户注册
     *
     * @param PersonCreate $request
     * @param PersonModel $person
     * @throws SuccessMessage
     */
    public function create(PersonCreate $request, PersonModel $person)
    {
        $data = $request->validated();

        $person::create($data);

        throw new SuccessMessage(['message' => '创建成功']);
    }

    /**
     * 获取自己的信息
     * @param Request $request
     * @param PersonModel $person
     * @throws MissException
     * @throws SuccessMessage
     * @throws \App\Exceptions\TokenException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function info(Request $request, PersonModel $person)
    {
        $id = \App\Http\Service\Token::getCurrentTokenVar($request, 'id');

        $info = $person::find($id);
        if (empty($info)) throw new MissException();

        throw new SuccessMessage(['data' => $info->toArray()]);
    }
}
