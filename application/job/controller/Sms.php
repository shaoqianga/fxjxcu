<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:28
 */
namespace app\job;
use think\Controller;
use think\Exception;

class Sms extends Controller {

    public function start()
    {
        $pheanstalk = new \Pheanstalk\Pheanstalk(
            config('beanstalk.host'),
            config('beanstalk.port'));
        while (true){
            if(!$pheanstalk->getConnection()->isServiceListening())
            {
                echo 'error connecting to beanstalk ,sleeping for 5
            second';

                sleep(5);

                continue;
            }

            $job = $pheanstalk
                ->watch(config('beanstalk.SMS'))
                ->ignore('default')
                ->reserve();

            $data = json_encode($job->getData(),true);

            try{
                //send sms code
                $this->send_sms_code($data['phone'],$data['message']);
                $pheanstalk->delete($job);

                //记录发送日志
            }catch (Exception $e)
            {
                //记录失败发送日志
            }
        }
    }


    private function send_sms_code($phone,$message){

        header("Content-type: textml; charset=utf-8");
        date_default_timezone_set('PRC');
        $uid = 'CDJS001813';
        $passwd = 'zm0513@';

        $msg = rawurlencode(mb_convert_encoding($message, "gb2312", "utf-8"));

        $gateway = "https://sdk2.028lk.com/sdk2/BatchSend2.aspx?CorpID={$uid}&Pwd={$passwd}&Mobile={$phone}&Content={$msg}&Cell=&SendTime=";

        $result = file_get_contents($gateway);

        return $result;
    }

}