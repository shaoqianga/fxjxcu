<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
Route::get('captcha/:id','home/Captcha/index');
Route::post('captcha/:id','home/Captcha/read')
        ->middleware('Reqcode');
Route::rule('public/user/login','home/User/index')
        ->middleware('Reqlogin');

/*Route::rule('user/edit/:id','home/user/edit')
    ->middleware(['CheckLogin','CsrfToken']);*/

