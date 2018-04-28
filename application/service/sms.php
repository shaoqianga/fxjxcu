<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:04
 */
namespace app\service;
class sms {


    public function send($phone,$data)
    {
        /*
         * $data = [
         *      'type'=>
         *      'sms_code'=>
         *      'username'=>
         *      'mounth'=>
         *      'day'=>
         *      'address'=>
         *      'landlord_phone'=>
         *      'hour'=>
         *      'oid'=>
         * ]
         *
         * */
        //放入手机验证码队列
        $pheanstalk = new \Pheanstalk\Pheanstalk(
            config('beanstalk.host'),
            config('beanstalk.port'));
        var_dump($pheanstalk->stats());die;
        $pheanstalk->useTube(config('beanstalk.SMS'))
            ->put($this->paresData($phone,$this->parseMessage($data)));
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

    public function paresData($phone,$message)
    {
        $jobData = array(
            'phone'=>$phone,
            'message'=>$message,
            'time' => date('Y-m-d H:i:s')
        );
        return json_encode($jobData);
    }

    private function parseMessage($data){

        switch ($data['type']){
            case 1:
                $message = '您的手机验证码为'.$data['code'].'，请输入此号码，如果非本人操作请忽略';
                break;
            case 2:
                $message = '尊敬的'.$data['username'].'，已有房客选中您的房子啦，
                   赶快上线来处理订单吧！详情请点击 www.fxj178.com';
                break;
            case 3:
                $message = '房东接受了您的预订，登录www.fxj178.com付房款
                  ，分享家全程为您担保，确认入住后才会打款给房东。订单将在16个小时后失效';
                break;
            case 4:
                $message = '亲！五分钟过去了，您的预订尚未完成，
                  请尽快支付房款，以免房东将房子租给其他房客';
                break;
            case 5:
                $message = '亲！您的订单已预订成功，房东联系电话'.
                    $data['landlord_phone'].',地址'.$data['address'].'。'
                    .'若行程有变动需更改或取消订单，请提前通知我们。您可通过“分享家短租平台”APP下单查单';
                break;
            case 6:
                $message = '尊敬的'.$data['name'].'，已有房客成功预定房间，
                  该房客将于'.$data['month'].'月'.$data['day'].'日'.$data['hour'].
                    '点入住，请您提前预留出相应的房间。';
                break;
            case 7:
                $message = '尊敬的'.$data['name'].'：今日有房客将会抵达您的房子并入住
                  ，敬请做好您的接待，我们期待着房客与您的相遇。详情点击www.fxj178.com';
                break;
            case 8:
                $message = '亲！不要忘记今日的行程！房东已为您准备好了一切，
                 张开怀抱去享受当地温馨的人文气息吧！详情点击www.fxj178.com';
                break;
            case 9:
                $message = '很抱歉，订单'.$data['oid'].'您所选择房间的房东暂不能为您提供服务。
                  您可通过“分享家短租平台”APP下单查单';
                break;
            case 10:
                $message = $data;
                break;
        }
        return $message;
    }

}