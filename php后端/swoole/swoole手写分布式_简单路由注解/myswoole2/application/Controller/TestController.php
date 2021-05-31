<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/4/9
 * Time: 11:34
 */

namespace App\   Controller;

/**
 * Class TestController
 * @Controller(prefix="test")
 */
class TestController
{
    /**
     *@RequestMapping(router="index")
     */
    public function index(){
        return  "控制器方法";
    }
    /**
     *@RequestMapping(router="test")
     */
    public function  test(){
        return "控制器方法";
    }
}
