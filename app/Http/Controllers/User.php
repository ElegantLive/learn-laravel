<?php

namespace App\Http\Controllers;

use App\Exceptions\TokenException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Mockery\Exception;

class User extends Controller
{
    public function create(Request $request)
    {
        $all = \App\User::all();
        $list = $all->toArray();
        throw new TokenException(['message' => '测试']);
        return Response::json([
            'list' => $list,
            'action' => $request->fullUrl()
        ]);
    }
}
