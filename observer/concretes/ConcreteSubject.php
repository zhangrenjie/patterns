<?php

namespace Observer\concretes;

use Observer\interfaces\Observer;
use Observer\interfaces\Subject;

require_once APP_PATH . 'interfaces/Subject.php';


class ConcreteSubject implements Subject
{
    private $observers = [];

    /**
     * 添加观察者实例
     * @param Observer $observer
     */
    public function attach(Observer $observer)
    {
        $observerID = $observer->observerID;
        if (!isset($this->observers[$observerID])) {
            $this->observers[$observerID] = $observer;
        }
        echo $observerID . "正在努力加入<br/>";
        return $this;
    }

    /**
     * 删除观察者实例
     * @param Observer $observer
     */
    public function detach(Observer $observer)
    {
        $observerID = $observer->observerID;
        if (isset($this->observers[$observerID])) {
            unset($this->observers[$observerID]);
        }
        echo $observerID . "已经退出<br/>";
        return $this;
    }

    /**
     * 通知
     * @return $this|void
     */
    public function notify(string $message)
    {
        if (empty($this->observers)) return;

        echo "<br/>各位请注意：<br/>";
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
        echo "<br/><br/>";
        return $this;
    }
}