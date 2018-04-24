<?php

namespace Observer\concretes;

use Observer\interfaces\Observer;

require_once APP_PATH . 'interfaces/Observer.php';


class ConcreteObserver implements Observer
{
    private $observerName;//观察者的名称
    public $observerID;

    public function __construct(string $observerName, string $observerID)
    {
        $this->observerName = $observerName;
        $this->observerID = $observerID;
    }

    /**
     * 更新方法
     */
    public function update(string $actionName)
    {
        echo '观察着', $this->observerName, ' 接收到' . $actionName . '通知.<br />';
    }
}