<?php

namespace patterns\spl_observer\user2\subjects;

use \SplSubject;
use \SplObserver;
use \SplObjectStorage;

class UserSubject implements SplSubject
{
    private $email;
    private $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        if (!$this->observers->contains($observer)) {
            $this->observers->attach($observer);
        }
    }

    public function detach(SplObserver $observer)
    {
        if ($this->observers->contains($observer)) {
            $this->observers->detach($observer);
        }
    }

    public function notify()
    {
        if ($this->observers->count()) {
            $this->observers->rewind();

            while ($this->observers->valid()) {
                $observer = $this->observers->current();
                $observer->update($this);
                $this->observers->next();
            }
        }

//        foreach ($this->observers as $observer) {
//            $observer->update($this);
//        }
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }
}