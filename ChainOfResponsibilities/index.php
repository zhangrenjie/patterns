<?php

//申请
class Apply
{
    public $memberName;//申请人名称
    public $time;//申请时间
    public $number;//申请数量
    public $type;//申请类型
    public $content;//申请内容

    public function __construct(string $memberName, string $type, string $time, string $number, string $content)
    {
        $this->memberName = $memberName;
        $this->type = $type;
        $this->time = $time;
        $this->number = $number;
        $this->content = $content;
    }
}

//抽象管理者
abstract class Manager
{
    protected $name;//名称
    protected $superior = null;//上司

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * 设置上司
     * @param Manager $manager
     */
    public function setSuperior(Manager $manager)
    {
        $this->superior = $manager;
    }


    abstract public function verifyApply(Apply $apply);
}

//普通经理
class CommonManager extends Manager
{

    public function verifyApply(Apply $apply)
    {
        if ($apply->type == '请假' && $apply->time <= 2) {
            echo $this->name . '批准了' . $apply->memberName . '的' . $apply->type . $apply->time . '天的申请';
            echo "<p>";
        } else {
            //如果有上级则交给上级审批
            if (!empty($this->superior)) {
                $this->superior->VerifyApply($apply);
            }
        }
    }
}

//总监
class MajorDomo extends Manager
{

    public function verifyApply(Apply $apply)
    {
        if ($apply->type == '请假' && $apply->time <= 5) {
            echo $this->name . '批准了' . $apply->memberName . '的' . $apply->type . $apply->time . '天的申请';
            echo "<p>";
        } else {
            //如果有上级则交给上级审批
            if (!empty($this->superior)) {
                $this->superior->VerifyApply($apply);
            }
        }
    }
}

//总经理
class GeneralManager extends Manager
{
    public function verifyApply(Apply $apply)
    {
        if ($apply->type == "请假") {
            echo $this->name . '批准了' . $apply->memberName . '的' . $apply->type . $apply->time . '天的申请';
        } elseif ($apply->type == "加薪" && $apply->number <= 500) {
            echo "{$this->name}同意{$apply->memberName}{$apply->type}{$apply->number}元";
        } else if ($apply->type == "加薪" && $apply->number > 500) {
            echo "{$this->name}不同意{$apply->memberName}{$apply->type}{$apply->number}元，明年再谈吧";
        } else {
            echo "{$this->name}拒绝{$apply->memberName}{$apply->type}申请";
        }
        echo "<p>";
    }
}

//实例化各等级经理
$MrZhang = new CommonManager('张三经理');
$MrWu = new MajorDomo('武总监');
$MrMa = new GeneralManager('马云');


//设置直接上司
$MrZhang->setSuperior($MrWu);
$MrWu->setSuperior($MrMa);

$apply1 = new Apply('加富', '请假', 1, 0, '加富身体不适');
$MrZhang->verifyApply($apply1);

$apply2 = new Apply('加富', '请假', 3, 0, '加富身体不适');
$MrZhang->verifyApply($apply2);


$apply3 = new Apply('加富', '加薪', 0, 1000, '穷阿，再多给点吧');
$MrZhang->verifyApply($apply3);


$apply3 = new Apply('加富', '加薪', 0, 2, '穷阿，再多给点吧');
$MrZhang->verifyApply($apply3);







