<?php

namespace app\http\middleware;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        //检查用户是否登陆
        return $next($request);
    }
}
