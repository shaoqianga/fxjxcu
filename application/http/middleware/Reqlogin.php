<?php

namespace app\http\middleware;
use think\Validate;
class Reqlogin
{
    public function handle($request, \Closure $next)
    {
        //用户登陆请求数据验证
        $validate = Validate::make([
            '手机号'  => 'require|mobile',
            '验证码'   => 'require|number|length:6'
        ]);
        $data = [
            '手机号'  => $request->param('phone'),
            '验证码'  => $request->param('code'),
        ];
        if (!$validate->check($data)) {
            return json(['msg'=>$validate->getError()],200);
        }
        return $next($request);
    }
}
