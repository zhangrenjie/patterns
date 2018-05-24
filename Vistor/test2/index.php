<?php

//抽象访问者Visitor
abstract class Visitor
{
    abstract public function visitConcreteElementA(ConcreteElementA $elementA);

    abstract public function visitConcreteElementB(ConcreteElementB $elementB);
}

//抽象节点角色
abstract class Element
{
    abstract public function accept(Visitor $visitor);
}

//定义具体节点角色ConcreteElement
class ConcreteElementA extends Element
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visitConcreteElementA($this);
    }
}

class ConcreteElementB extends Element
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    //接受具体的访问者
    public function accept(Visitor $visitor)
    {
        $visitor->visitConcreteElementB($this);
    }
}


//定义具体访问者1
class ConcreteVisitor1 extends Visitor
{
    public function visitConcreteElementA(ConcreteElementA $elementA)
    {
        echo ($elementA->getName() . " visited by ConcerteVisitor1") . PHP_EOL;
    }

    public function visitConcreteElementB(ConcreteElementB $elementB)
    {
        echo ($elementB->getName() . " visited by ConcerteVisitor1") . PHP_EOL;
    }
}

//定义具体访问者2
class ConcreteVisitor2 extends Visitor
{
    public function visitConcreteElementA(ConcreteElementA $elementA)
    {
        echo ($elementA->getName() . " visited by ConcerteVisitor2") . PHP_EOL;
    }

    public function visitConcreteElementB(ConcreteElementB $elementB)
    {
        echo ($elementB->getName() . " visited by ConcerteVisitor2") . PHP_EOL;
    }
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
    public function attach(Element $element)
    {
        if (!$this->container->contains($element)) {
            $this->container->attach($element);
        }
    }

    //删除对象
    public function detach(Element $element)
    {
        if ($this->container->contains($element)) {
            $this->container->detach($element);
        }
    }

    //
    public function accept(Visitor $visitor)
    {
        $this->container->rewind();
        while ($this->container->valid()) {
            $this->container->current()->accept($visitor);
            $this->container->next();
        }
    }

}

$elementA = new ConcreteElementA('ElementA');
$elementB = new ConcreteElementB('ElementB');
$elementA2 = new ConcreteElementA('ElementA2');

$visitor1 = new ConcreteVisitor1();
$visitor2 = new ConcreteVisitor2();

$container = new ObjectStructure();
$container->attach($elementA);
$container->attach($elementB);
$container->attach($elementA2);
$container->detach($elementA);

$container->accept($visitor1);
$container->accept($visitor2);


