<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 18-4-24
 * Time: 下午8:37
 */

class Person
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

//实例化对象
$zhangsan = new Person('张三');
$lisi = new Person('李四');
$wangwu = new Person('王五');
$zhaoliu = new Person('赵六');

//实例化对象存储
$container = new SplObjectStorage();

//往存储空间写入对象
$container->attach($zhangsan);
$container->attach($lisi);
$container->attach($wangwu);
$container->attach($zhaoliu);

//统计存储空间里面的对象的数量
echo "存储对象数量" . $container->count();
echo "<br/>";

//判断指定的对象是否在存储空间中
echo "是否包含指定对象:";
var_dump($container->contains($lisi));
echo "<br/>";

//从存储中删除指定对象
echo "删除指定对象";
$container->detach($wangwu);

//查看当前指针所在的索引位置
echo "指针索引" . $container->key();
echo "<br/>";

//重置存储空间指针
$container->rewind();

//校验当前指针是否有效
var_dump($container->valid());


echo "<pre>";
while ($container->valid()) {

    //获取当前指针位置的对象
    var_dump($container->current());

    //存储空间指针下移
    $container->next();
}
