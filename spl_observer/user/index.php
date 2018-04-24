<?php

namespace user;

use user\observers\CreateAccount;
use user\observers\SendMail;
use user\subjects\User;

define('APP_PATH', __DIR__ . '/');

require_once APP_PATH . 'observers/CreateAccount.php';
require_once APP_PATH . 'observers/SendMail.php';
require_once APP_PATH . 'subjects/User.php';

//创建业务的主题场景
$subject = new User;

//增加观察者
$sendMail = new SendMail;
$createAccount = new CreateAccount;

//业务操作并通知
$subject->addUser('强东', 'dongge@jd.com')
    ->attach($createAccount)
    ->attach($sendMail)
    ->notify();

echo "<p>";

$subject->addUser('马云', 'jack@ma.com')
    ->detach($sendMail)
    ->notify();

echo "<p>";

$subject->addUser('思聪', 'si@cong.com')
    ->attach($sendMail)
    ->notify();
