<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/24
 * Time: 18:09
 */

namespace App\Http\Controllers;


use App\Exceptions\SuccessMessage;
use App\Http\Requests\PersonLogin;
use App\Http\Service\Token as TokenModel;
use Illuminate\Http\Request;

class Token extends Controller
{
    /**
     * 登录入口
     * @param PersonLogin $request
     * @param TokenModel $model
     * @throws SuccessMessage
     * @throws \App\Exceptions\MissException
     * @throws \App\Exceptions\TokenException
     */
    public function getToken(PersonLogin $request, TokenModel $model)
    {
        $map = $request->only(['mobile', 'password']);
        $token = $model->getToken($map);

        throw new SuccessMessage([
            'data' => ['token' => $token]
        ]);
    }

    /**
     * 退出
     * @param Request $request
     * @param TokenModel $model
     * @throws SuccessMessage
     */
    public function logout(Request $request, TokenModel $model)
    {
        $model->clearToken($request);

        throw new SuccessMessage();
    }
}