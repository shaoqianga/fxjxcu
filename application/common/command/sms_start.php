<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/28
 * Time: 13:48
 */
namespace app\common\command;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class sms_start extends Command{

    /**
     *启动sms 命令行
     */
    protected function configure()
    {
        $this->setName('sms_start')
            ->addArgument('name', Argument::OPTIONAL, "sms");
    }

    protected function execute(Input $input, Output $output)
    {

        $pheanstalk = new \Pheanstalk\Pheanstalk(
            config('beanstalk.host'),
            config('beanstalk.port'));
        while (true){

            if(!$pheanstalk->getConnection()->isServiceListening())
            {
                $output->writeln('error connecting to beanstalk ,sleeping for 5
            second');
                sleep(5);

                continue;
            }

            $job = $pheanstalk
                ->watch(config('beanstalk.SMS'))
                ->ignore('default')
                ->reserve();

            $dataOrigin = $job->getData();

            $data = json_decode($dataOrigin,true);

            try{
                //send sms code
                $this->send_sms_code($data['phone'],$data['message']);
                $pheanstalk->delete($job);
                $output->writeln('SUCCESS--TIME:'.date('Ymd H-i-s').':'.$dataOrigin);
                //记录发送日志
            }catch (Exception $e)
            {
                //记录失败发送日志
                $output->writeln('FAIL--TIME:'.date('Ymd H-i-s').':'.$dataOrigin);
            }

            sleep(1);
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