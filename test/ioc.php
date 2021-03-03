<?php
require_once '../vendor/autoload.php';

use LaravelStar\Container\Container;



$ioc = new Container();

class mysql
{
    public function index()
    {
        return 'mysql';
    }
}

class wechat implements zhifu
{
    public function pay()
    {
        return 'wechat';
    }
}


class alipay implements zhifu
{
    public function pay()
    {
        return 'alipay';
    }
}

interface zhifu
{
    public function pay();
}



# 接口 实现的子类  必须要实现接口中的所有方法 并且方法名和变量个数
interface db_database
{

}

// 抽象类
abstract class db {
}

$ioc->bind(db_database::class,mysql::class);
$ioc->bind('db1',mysql::class);
$ioc->bind('db2',function (){
    return new mysql();
});
//$ioc->bind('db3', new mysql());
//var_dump($ioc->getBindings());
//var_dump($ioc->make('db2')->index());
$ioc->bind('db',alipay::class);
//var_dump(zhifu::class);
//var_dump($ioc->getBindings());
var_dump($ioc->make('db')->pay());


