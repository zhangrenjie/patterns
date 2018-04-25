<?php

namespace patterns\spl_observer\user2;

use patterns\spl_observer\user2\observers\UserObserver;
use patterns\spl_observer\user2\subjects\UserSubject;

define('APP_PATH', __DIR__ . '/');
require_once APP_PATH . 'subjects/UserSubject.php';
require_once APP_PATH . 'observers/UserObserver.php';

$observer = new UserObserver();

$user = new UserSubject();
$user->attach($observer);
$user->changeEmail('jack@ma.com');

$observer->getChangedUsers();
