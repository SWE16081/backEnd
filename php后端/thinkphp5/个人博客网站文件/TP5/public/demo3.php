<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2018/8/23
 * Time: 10:48
 */
namespace  beijing\haidian\tiananmen;
header("content-type:text/html;charset=utf8");//设置字符编码
class Animals2
{
    public $obj='dog';
    static $name='暗淡';
}
function getMes()
{
    echo"123";
}

namespace  shanghai\putuo\dong;
class Animals
{
    public $obj='pig';
    static $name='哈哈哈';
}
function getMes()
{
    echo"456";
}
use beijing\haidian\tiananmen;//引入空间
getMes();  //456
tiananmen\getMes();//123
$animal=new Animals();
echo $animal->obj;
$animal=new tiananmen\Animals2();
echo $animal->obj;
use beijing\haidian\tiananmen\Animals2;//引入类
echo Animals2::$name;
