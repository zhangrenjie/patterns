<?php
/**
 * Interface Subject
 * 抽象主题角色
 */
namespace Observer\interfaces;

interface Subject
{
    /**
     * 增加（注册）观察者对象
     * @param Observer $observer
     * @return mixed
     */
    public function attach(Observer $observer);

    /**
     * 删除注册的观察者对象
     * @param Observer $observer
     * @return mixed
     */
    public function detach(Observer $observer);

    /**
     * 通知各观察者
     * @return mixed
     */
    public function notify(string $message);
}