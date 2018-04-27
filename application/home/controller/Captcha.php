<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
class Captcha extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //图形验证码获取
        $captcha = new \think\captcha\Captcha();

        return $captcha->entry();
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $captcha = new \think\captcha\Captcha();
        if( !$captcha->check($id))
        {
            // 验证失败
            return ['err'=>1,'message'=>'图形验证码错误'];
        }

        return ['err'=>0,'message'=>'验证成功'];
    }


}
