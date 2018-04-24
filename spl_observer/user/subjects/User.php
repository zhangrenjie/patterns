<?php
/**
 * 观察主题
 * SplSubject {
 * abstract public void attach ( SplObserver $observer )
 * abstract public void detach ( SplObserver $observer )
 * abstract public void notify ( void )
 * }
 * SplSubject::attach — Attach an SplObserver
 * SplSubject::detach — Detach an observer
 * SplSubject::notify — Notify an observer * SplObserver {
 *
 * SplObserver{
 *   abstract public void update ( SplSubject $subject )
 * }
 * SplObserver::update — Receive update from subject
 *
 */

namespace user\subjects;

use \SplSubject;
use \SplObserver;

class User implements SplSubject
{
    private $observers = null;

    public $userName;
    public $email;

    public $title;
    public $content;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    /**
     * 增加观察者
     * @param SplObserver $observer
     * @return $this
     */
    public function attach(SplObserver $observer)
    {
//        if (array_search($observer, $this->observers, true) === false) {
//            $this->observers[] = $observer;
//        }
        if (!$this->observers->contains($observer)) {
            $this->observers->attach($observer);
        }
        return $this;
    }

    /**
     * 删除观察者
     * @param SplObserver $observer
     * @return $this
     */
    public function detach(SplObserver $observer)
    {
//        if ($key = array_search($observer, $this->observers, true) !== false) {
//            unset($this->observers[$key]);
//        }
        if ($this->observers->contains($observer)) {
            $this->observers->detach($observer);
        }
        return $this;
    }

    /**
     * 通知观察者
     */
    public function notify()
    {
//        if (!empty($this->observers)) {
//            foreach ($this->observers as $observer) {
//                $observer->update($this);
//            }
//        }

        if (count($this->observers)) {
            $this->observers->rewind();
            while ($this->observers->valid()) {
                $observer = $this->observers->current();
                $observer->update($this);
                $this->observers->next();
            }
        }
    }

    public function addUser(string $userName, string $email)
    {
        $this->email = $email;
        $this->userName = $userName;
        $this->title = '创建新用户';
        $this->content = '用户' . $userName . '创建成功';
        return $this;
    }

}







