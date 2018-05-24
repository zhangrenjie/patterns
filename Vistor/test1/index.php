<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 18-5-18
 * Time: 上午11:39
 */
declare(strict_types=1);//开启强类型模式

/**
 * 人
 * Class Person
 */
abstract class Person
{
    public $sex;//性别

    //接受访问者对象
    public abstract function Accept(State $visitor);
}

/**
 * 状态
 * Class State
 */
abstract class State
{
    protected $stateName;

    public abstract function getMaleAction(Male $male);

    public abstract function getFemaleAction(Female $female);
}

class Success extends State
{
    public function __construct()
    {
        $this->stateName = '成功';
    }

    public function getMaleAction(Male $male)
    {
        echo "{$male->sex}:{$this->stateName}时，背后多半有一个伟大的女人。" . PHP_EOL;
    }

    public function getFemaleAction(Female $female)
    {
        echo "{$female->sex}:{$this->stateName}时，背后大多有一个不成功的男人。" . PHP_EOL;
    }
}

class Failure extends State
{
    public function __construct()
    {
        $this->stateName = '失败';
    }

    public function getMaleAction(Male $male)
    {
        echo "{$male->sex}:{$this->stateName}时，闷头喝酒，谁也不用劝。" . PHP_EOL;
    }

    public function getFemaleAction(Female $female)
    {
        echo "{$female->sex}:{$this->stateName}时，眼泪汪汪，谁也劝不了。" . PHP_EOL;
    }
}

class Amativeness extends State
{
    public function __construct()
    {
        $this->StateName = "恋爱";
    }

    public function getMaleAction(Male $male)
    {
        echo "{$male->sex}:{$this->StateName}时，凡事不懂也要装懂。" . PHP_EOL;
    }

    public function getFemaleAction(Female $female)
    {
        echo "{$female->sex} :{$this->StateName}时，遇事懂也要装作不懂。" . PHP_EOL;
    }
}

class Male extends Person
{
    public function __construct()
    {
        $this->sex = '男人';
    }

    public function Accept(State $visitor)
    {
        $visitor->getMaleAction($this);
    }
}

class Female extends Person
{
    public function __construct()
    {
        $this->sex = '女人';
    }

    public function Accept(State $visitor)
    {
        $visitor->getFemaleAction($this);
    }
}

class ObjectContainer
{
    private $container;

    public function __construct()
    {
        $this->container = new SplObjectStorage();
    }

    //添加对象
    public function Add(Person $element)
    {
        if (!$this->container->contains($element)) {
            $this->container->attach($element);
        }
    }

    //删除对象
    public function Remove(Person $element)
    {
        if ($this->container->contains($element)) {
            $this->container->detach($element);
        }
    }

    //遍历显示
    public function Display(State $visitor)
    {
        $this->container->rewind();
        while ($this->container->valid()) {
            $this->container->current()->Accept($visitor);
            $this->container->next();
        }
    }
}

$container = new ObjectContainer();
$container->Add(new Male());
$container->Add(new Female());

$state1 = new Success();
$container->Display($state1);

$state2 = new Failure();
$container->Display($state2);

$state3 = new Amativeness();
$container->Display($state3);



