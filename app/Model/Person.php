<?php

namespace App\Model;


class Person extends BaseModel
{
    const SEX_ALIAS = ['MAN' => '♂', 'WOMEN' => '♀'];

    protected $fillable = ['name','password', 'sex', 'real_name', 'email', 'mobile'];


    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s' ,$value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s' ,$value);
    }

    public function getSexAttribute($value)
    {
        return self::SEX_ALIAS[$value];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }
}
