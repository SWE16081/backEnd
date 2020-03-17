<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2018/8/23
 * Time: 11:04
 */
namespace  beijing;
header("content-type:text/html;charset=utf8");//设置字符编码
class Animals2
{
    public $obj='dog';
    static $name='暗淡';
}
const NM="demo";
function getMes()
{
    echo"123";
}
//include("./demo4.2.php");//引入空间对当前空间没有影响
// getMes();
//echo NM;//当前空间没有NM去公共空间查找
//echo \NM;