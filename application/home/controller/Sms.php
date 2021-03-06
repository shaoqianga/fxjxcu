<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Sms extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $sms = new \app\service\sms();
        //$sms->send($request->param('phone'));
        $sms->send(13908109010,['type'=>1,'code'=>'123433']);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function check(Request $request)
    {
        $data = [
            'phone'=>$request->param('phone'),
            'code' =>$request->param('code')
        ];
        //登陆成功触发短信队列
        $sms = new \app\service\sms();
        $sms->check($data);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //asdf
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
