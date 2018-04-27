<?php

namespace app\http\middleware;
use think\Validate;
class Reqcode
{
    public function handle($request, \Closure $next)
    {
        //图形验证码验证
        $validate = Validate::make([
            '图形验证码'   => 'require'
        ]);
        $data = [
            '图形验证码'  => $request->param('captcha'),
        ];
        if (!$validate->check($data)) {
            return json(['msg'=>$validate->getError()],200);
        }
        return $next($request);
    }
}
