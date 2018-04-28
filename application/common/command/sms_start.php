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


    protected function configure()
    {
        $this->setName('sms_start')
            ->addArgument('name', Argument::OPTIONAL, "sms");
            //->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            //->setDescription('Say Hello');
    }

    protected function execute(Input $input, Output $output)
    {
        echo 'ccccccccc';
        /*$name = trim($input->getArgument('name'));
        $name = $name ?: 'thinkphp';

        if ($input->hasOption('city')) {
            $city = PHP_EOL . 'From ' . $input->getOption('city');
        } else {
            $city = '';
        }

        $output->writeln("Hello," . $name . '!' . $city);*/
    }

}