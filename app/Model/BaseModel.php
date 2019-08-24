<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = true;
    protected $dateFormat = 'U';
    protected $hidden = ['id', 'password'];

}
