<?php
/**
 * Created by PhpStorm.
 * User: 17679
 * Date: 2018/4/26
 * Time: 17:28
 */
namespace app\job;
class sms extends job{

    public function __construct()
    {
        $this->getIns();
    }
    /**生产消息
     * @param $job
     */
    public function addJob($tube,$job)
    {
        self::$ins->putJob($tube,$job);
    }
    /**
     *消费消息
     */
    public function useJob($tube)
    {
        self::$ins->reserveJob($tube);
    }

    public function run($tube)
    {
        echo 'yunxing ';
    }
}