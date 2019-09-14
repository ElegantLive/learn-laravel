<?php
/**
 * Created by PhpStorm.
 * User: qucaixian
 * Date: 2019/8/24
 * Time: 18:21
 */

namespace App\Http\Service;


use App\Exceptions\ForbiddenException;
use App\Exceptions\MissException;
use App\Exceptions\ParameterException;
use App\Exceptions\TokenException;
use App\Model\Person;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Token
{
    const USER_SCOPE  = 16;
    const OTHER_SCOPE = 32;
    const ADMIN_SCOPE = 64;

    /**
     * 换取token
     * @param array $map
     * @return string
     * @throws MissException
     * @throws TokenException
     */
    public function getToken (array $map = [])
    {
        $map['password'] = md5($map['password']);

        $person = Person::where($map)->first();

        if (empty($person) || $person->is) {
            throw new MissException();
        }

        $cache = [
            'scope'     => 8,
            'timestamp' => time(),
            'id'        => $person['id'],
        ];

        return $this->cacheToken($cache);
    }

    /**
     * 缓存token
     * @param array $value
     * @return string
     * @throws TokenException
     */
    private function cacheToken (array $value)
    {
        $key = $this->createRandKey();

        $res = Cache::store('redis')->put($key, $value, config('setting.token_expire_in'));
        if (empty($res)) {
            throw new TokenException([
                'message' => '请稍后再试'
            ]);
        }

        return $key;
    }

    /**
     * 清理token
     * @param Request $request
     */
    public function clearToken (Request $request)
    {
        Cache::store('redis')->forget($request->header('token'));
    }

    /**
     * 获取token存储信息
     * @param Request     $request
     * @param string|null $key
     * @return mixed
     * @throws TokenException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getCurrentTokenVar (Request $request, string $key = null)
    {
        if (empty($key)) {
            throw new TokenException(['message' => 'token找不到']);
        }

        $value = Cache::store('redis')->get($request->header('token'));
        if (empty($value)) {
            throw new TokenException();
        }

        if (array_key_exists($key, $value)) {
            return $value[$key];
        }

        throw new TokenException();
    }

    /**
     * 校验权限
     * @param Request $request
     * @param int     $scope
     * @throws ForbiddenException
     * @throws ParameterException
     * @throws TokenException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function authentication (Request $request, int $scope)
    {
        if (in_array($scope, [16, 32, 64]) == false) {
            throw new ParameterException();
        }

        $scopeVal = self::getCurrentTokenVar($request, 'scope');
        if (empty($scopeVal)) {
            throw new TokenException();
        }

        if ($scope != $scopeVal) {
            throw new ForbiddenException();
        }
    }

    /**
     * 生成token的key
     * @return string
     */
    private function createRandKey ()
    {
        return Factory::create()->md5;
    }
}