<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/28
 * Time: 15:05
 */
namespace app\common\command;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
class beanstalk_status extends Command{
    protected function configure()
    {
        $this->setName('beanstalk_status')
            ->addArgument('tube', Argument::OPTIONAL, "beanstalk_stats")
            ->addArgument('jobId',Argument::OPTIONAL,'job_stats');
    }
    protected function execute(Input $input, Output $output)
    {

        $pheanstalk = new \Pheanstalk\Pheanstalk(
            config('beanstalk.host'),
            config('beanstalk.port'));

        $output->writeln($pheanstalk->stats());

        $output->writeln($pheanstalk->listTubeUsed());

        $tube = trim($input->getArgument('tube'));

        if($tube){
            //$output->writeln($tube);
            $output->writeln($pheanstalk->statsTube($tube));
        }

        $jobId = trim($input->getArgument('jobId'));

        if($jobId){
            //$output->writeln($jobId);
            $output->writeln($pheanstalk->statsJob($jobId));
        }
    }

}