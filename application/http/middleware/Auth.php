<?php

namespace app\http\middleware;

class Auth
{
    public function handle($request, \Closure $next)
    {
        //检查用户 操作权限
        return $next($request);
    }
}
