<?php

namespace App\Http\Controllers;

use App\Exceptions\MissException;
use App\Exceptions\SuccessMessage;
use App\Model\Person;
use Illuminate\Http\Request;

/**
 * Class User
 * @package App\Http\Controllers
 */
class User extends Controller
{
    /**
     * 创建用户
     * @param Request $request
     * @throws SuccessMessage
     */
    public function create(Request $request)
    {
//        $user = new \App\User();
        $all = Person::all()->toArray();
        throw new SuccessMessage(['data' => $all]);
//        throw new TokenException(['message' => '测试']);
    }

    /**
     * 获取用户分页列表
     * @param Request $request
     * @param Person $person
     * @return mixed
     */
    public function list(Request $request, Person $person)
    {
        return $person->where('id', '>', 10)->paginate(1, '*', 'page', 3);
    }

    /**
     * 获取用户详情
     * @param Request $request
     * @throws MissException
     * @throws SuccessMessage
     */
    public function detail(Request $request)
    {
        $info = Person::find(4);

        if (empty($info)) throw new MissException();

        throw new SuccessMessage(['data' => $info]);
    }
}
