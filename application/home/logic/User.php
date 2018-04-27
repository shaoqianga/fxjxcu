<?php

namespace app\home\logic;

use think\Model;
use think\Session;

class User extends Model
{

    public function login($user)
    {
        $verifyCodeKey = config('LOGIN_CODE_PRE_KEY').$user['phone'];
        //判断手机验证码
        if(!session("?$verifyCodeKey")
            ||$user['code'] !== Session::get($verifyCodeKey))
        {
            return ['err'=>1,'message'=>'验证码不正确'];
        }
        //判断手机号
        $exist_phone = model('User')
            ->field('phone')
            ->scope('phone',$user['phone'])
            ->find();
        if(!$exist_phone)
        {
            return ['err'=>1,'message'=>'用户账号不存在'];
        }

        //登陆成功触发短信队列


        return ['err'=>0,'message'=>'用户登陆成功'];
    }
}
