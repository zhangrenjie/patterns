<?php

namespace Observer;

define('APP_PATH', __DIR__ . '/');

require_once APP_PATH . 'concretes/ConcreteObserver.php';
require_once APP_PATH . 'concretes/ConcreteSubject.php';

use Observer\concretes\ConcreteSubject;
use Observer\concretes\ConcreteObserver;


//--1.实例化场景
$subject = new ConcreteSubject();

//--2.实例化多个观察者
$jack = new ConcreteObserver('杰克', 'jack');
$zhangsan = new ConcreteObserver('张三', 'zhangsan');
$lisi = new ConcreteObserver('李四', 'lisi');

//--3.添加观察者并通知
$subject->attach($jack)->attach($zhangsan)->attach($lisi)->notify('领红包');

//--5.删除一个观察者后再通知
$subject->detach($jack)->notify('睡觉');

//--6.临时加入了观察者
$subject->attach(new ConcreteObserver('肉丝', 'rose'))->notify('起床');


