<?php
namespace user\observers;

use \SplSubject;
use \SplObserver;

class SendMail implements SplObserver
{
    public function update(SplSubject $subject)
    {
        $this->sendEmail($subject->email, $subject->title, $subject->content);
    }

    private function sendEmail(string $email, string $title, string $content)
    {
        echo "邮件发给:{$email}<br/>标题：{$title}<br/>内容:{$content}<br/>";
    }
}