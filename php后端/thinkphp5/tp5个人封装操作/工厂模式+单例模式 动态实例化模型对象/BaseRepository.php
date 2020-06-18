<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/17
 * Time: 15:20
 */

namespace app\Repository;


use app\interfaces\RepositoryInterface;
use think\App;

/** 工厂模式+单例模式 动态实例化模型对象
 * Class BaseRepository
 * @package app\Repository
 */
class BaseRepository
{

     protected static $model;//静态变量存储唯一实例

    function __construct(){}

     public  static function getModel($app){
        if(!self::$model){
            self::$model=new $app();
            return self::$model;
        }else{
            return self::$model;
        }
    }
}