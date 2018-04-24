<?php

namespace user\observers;

use \SplSubject;
use \SplObserver;

class CreateAccount implements SplObserver
{
    public function update(SplSubject $subject)
    {
        $this->createAmount($subject->userName);
    }

    private function createAmount(string $userName)
    {
        echo "为{$userName}创建帐号成功<br/><br/>";
    }
}