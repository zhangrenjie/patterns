<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 18-5-24
 * Time: 下午3:24
 */
declare(strict_types=1);//开启强类型模式

//定义抽象游客类（抽象元素）
abstract class Tourist
{
    //接受访问者访问（传入访问者对象）
    abstract function accept(Visitor $visitor);
}


//定义抽象访问者
abstract class Visitor
{
    //老年游客政策
    abstract function visitOlder();

    //儿童游客政策
    abstract function visitKids();

    //成人游客政策
    abstract function visitAdult();
}

//对象结构角色(ObjectStructure)
class ObjectStructure
{
    private $container;

    public function __construct()
    {
        $this->container = new SplObjectStorage();
    }

    //添加对象
    public function attach(Tourist $element)
    {
        if (!$this->container->contains($element)) {
            $this->container->attach($element);
        }
    }

    //删除对象
    public function detach(Tourist $element)
    {
        if ($this->container->contains($element)) {
            $this->container->detach($element);
        }
    }

    //接受访问对象
    public function accept(Visitor $visitor)
    {
        $this->container->rewind();
        while ($this->container->valid()) {
            $this->container->current()->accept($visitor);
            $this->container->next();
        }
    }
}

//实例化游客（访问元素）

//定义老年游客
class OlderTourist extends Tourist
{
    public function accept(Visitor $visitor)
    {
        $visitor->visitOlder();
    }
}

//定义儿童游客
class KidsTourist extends Tourist
{
    public function accept(Visitor $visitor)
    {
        $visitor->visitKids();
    }
}


//定义成人游客
class AdultTourist extends Tourist
{
    public function accept(Visitor $visitor)
    {
        $visitor->visitAdult();
    }
}

//旺季游客收费政策
class BusySeason extends Visitor
{
    public function visitOlder()
    {
        echo "旺季老人半价" . PHP_EOL;
    }

    public function visitKids()
    {
        echo "旺季儿童半价" . PHP_EOL;
    }

    public function visitAdult()
    {
        echo "旺季成人全票" . PHP_EOL;
    }
}

//淡季游客收费政策
class SlackSeason extends Visitor
{
    public function visitOlder()
    {
        echo "淡季老人免费" . PHP_EOL;
    }

    public function visitKids()
    {
        echo "淡季儿童免费" . PHP_EOL;
    }

    public function visitAdult()
    {
        echo "淡季成人六折" . PHP_EOL;
    }
}

//春季游客收费政策
class SpringSeason extends Visitor
{
    public function visitOlder()
    {
        echo "春季老人半价" . PHP_EOL;
    }

    public function visitKids()
    {
        echo "春季儿童半价" . PHP_EOL;
    }

    public function visitAdult()
    {
        echo "春季成人全票" . PHP_EOL;
    }
}


$container = new ObjectStructure;
$container->attach(new OlderTourist);
$container->attach(new KidsTourist);
$container->attach(new AdultTourist);

//调用不同的访问者
$container->accept(new BusySeason);
$container->accept(new SlackSeason);
$container->accept(new SpringSeason);
