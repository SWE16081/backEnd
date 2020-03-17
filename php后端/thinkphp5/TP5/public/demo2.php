<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2018/8/23
 * Time: 9:57x
 *
 */
//1.非限定名称访问方式
//2.限定名称访问方式
//3.完全限定名称访问方式
namespace  beijing\haidian;
header("content-type:text/html;charset=utf8");//设置字符编码
function getMes()
{
    echo"123";
}
const test='qwe';

class Animals
{
public $obj='dog';
static $name='暗淡';
}
namespace  shanghai\putuo;
function getMes()
{
    echo"456";
}
const test='qwe123';
class Animals
{
public $obj='pig';
    static $name='哈哈哈';
}
getMes();//1.非限定名称访问方式
echo test;//1.非限定名称访问方式
$animal=new Animals();
echo $animal->obj;//1.非限定名称访问方式
echo Animals::$name;
echo'<br>';
\beijing\haidian\getMes();//3.完全限定名称访问方式
echo \beijing\haidian\test;//3.完全限定名称访问方式
$animal=new  \beijing\haidian\Animals();
echo $animal->obj;         //3.完全限定名称访问方式
echo \beijing\haidian\Animals::$name;
beijing\haidian\getMes();//2.限定名称访问方式
//限定名称访问方式---相对路径 --在当前命名空间找指定的命名空间   与完全限定名称访问方式---绝对路径
namespace  shanghai\putuo\beijing\haidian;
function getMes()
{
    echo"789";
}