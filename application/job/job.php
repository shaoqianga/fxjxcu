<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:09
 */
namespace app\job;
abstract class job{
    static protected $ins;
    protected $jobs = null;
    protected $data;
    public function __construct()
    {

    }

    public function __clone()
    {
        
    }
    public function getIns()
    {
        if(!self::$ins instanceof self){
            self::$ins = new \Pheanstalk\Pheanstalk(config('Pheanstalk_host'));
        }

        return self::$ins;
    }
    /**生成队列 tube job
     * @param $tube
     * @param $job
     * @return mixed
     */
    public function putJob($tube,$job)
    {
        return self::$ins->useTube($tube)
            ->put($job);
    }

    /**消费队列 tube 的job
     * 若失败 则写入失败日志
     * @param $tube
     */
    public function reserveJob($tube)
    {
        while(true)
        {
            $this->jobs = self::$ins->watch($tube)
                ->ignore('default')
                ->reserve();
            $data = $this->jobs->getData();
            $result = $this->run($data);
            if(!$result['err']){

            }
            usleep(1000);
        }
    }

    /**实现具体提取出的数据处理
     * @return mixed
     */
    abstract function run($data);

    public function deleteJob()
    {
        return $this->ins->delete($this->jobs);
    }

    public function checkConnection()
    {
        return $this->ins->getConnection()->isServiceListening();//true or false
    }
}