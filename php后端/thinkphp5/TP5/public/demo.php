<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2018/8/23
 * Time: 9:30
 */
namespace  swe;
function getMes()
{
    echo"123";
}
//define('demo','123');//用define定义的常量不同的命名空间不可重名
const test='qwe';

namespace  swe1;
//define('demo','123');
function getMes()
{
    echo"456";
}
const test='qwe123';////用const定义的常量不同的命名空间可重名
//getMes();//没有指明命名空间默认是最近的
\swe2\getMes();//调用swe2下的getMes()函数
echo test;

namespace  swe2;
const test='qwe122343';
function getMes()
{
    echo"789";
}