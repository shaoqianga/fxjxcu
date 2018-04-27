<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:28
 */
namespace app\job;
class sms extends job{
    /**生产消息
     * @param $job
     */
    public function addJob($tube,$job)
    {
        $this->putJob($tube,$job);
    }
    /**
     *消费消息
     */
    public function useJob($tube)
    {
        $this->reserveJob($tube);
    }

    public function run($tube)
    {
        echo 'yunxing ';
    }
}