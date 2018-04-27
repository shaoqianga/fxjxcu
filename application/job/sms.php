<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:28
 */
namespace app\job;
class sms extends job{
    private $tube = 'sms';
    /**生产消息
     * @param $job
     */
    public function addJob($job)
    {
        $this->putJob($this->tube,$job);
    }
    /**
     *消费消息
     */
    public function useJob()
    {
        $this->reserveJob($this->tube);
    }
}