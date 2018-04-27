<?php

namespace app\home\model;

use think\Model;

class User extends Model
{

    public function scopePhone($query,$phone)
    {
        $query->where('phone','=',$phone);
    }
}
