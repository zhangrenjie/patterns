<?php

namespace patterns\spl_observer\user2\observers;

use \SplObserver;
use \SplSubject;
use \SplObjectStorage;

class UserObserver implements SplObserver
{
    private $changedUsers = null;

    public function __construct()
    {
        $this->changedUsers = new SplObjectStorage();
    }

    /**
     * 被主题通知调用
     * SplSubject::notify()
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        $this->changedUsers->attach(clone $subject);
    }

    /**
     * 显示所有更新的用户
     */
    public function getChangedUsers()
    {
        if ($this->changedUsers->count()) {
            $this->changedUsers->rewind();
            echo "<pre>";
            while ($this->changedUsers->valid()) {
                var_dump($this->changedUsers->current());
                $this->changedUsers->next();
            }
        }
    }

}