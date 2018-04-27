<?php

namespace app\http\middleware;
use think\Validate;
class CsrfToken
{
    public function handle($request, \Closure $next)
    {
        $validate = Validate::make([
            'csrf'  => 'require|token',
        ]);
        $data = [
            'csrf'  => $request->param('csrf-token'),
        ];
        if (!$validate->check($data)) {
            return json(['msg'=>$validate->getError()],200);
        }
        return $next($request);
    }
}
