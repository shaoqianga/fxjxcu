<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/28
 * Time: 10:53
 */
namespace app\job;
use think\Controller;

class beanstalk extends Controller{
    private $ins;
    public function __construct()
    {
        $this->ins = new \Pheanstalk\Pheanstalk(
            config('beanstalk.host'),
            config('beanstalk.port'));
    }
    public function listTube()
    {
        $data = [
            'list'=>$this->ins->listTubes(),
            'used'=>$this->ins->listTubeUsed()
        ];
        return json_encode($data) ;
    }
}
