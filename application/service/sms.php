<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:04
 */
namespace app\service;
class sms {

    public function send($phone)
    {
        //发送验证码
        $code = $this->createCode();
        //放入手机验证码队列
        (new \app\job\sms())->putJob(config('beanstalk.SMS_CODE'),
            $this->paresData(config('beanstalk.SMS_CODE'),$phone,$code));
    }

    public function checkCode($phone,$code)
    {
        //检查验证码是否匹配
    }

    public function checkTims()
    {
        //检查发送的次数
    }

    public function createCode($length = 6)
    {
        $key='';
        $pattern='1234567890';
        for($i=0;$i<$length;++$i)
        {
            $key .= $pattern{mt_rand(0,9)}; // 生成php随机数
        }
        return $key;
    }

    public function paresData($tube,$phone,$data)
    {
        $jobData = array(
            'phone'=>$phone,
            'tube' =>$tube,
            'data' =>$data
        );
        return json_encode($jobData);
    }

}