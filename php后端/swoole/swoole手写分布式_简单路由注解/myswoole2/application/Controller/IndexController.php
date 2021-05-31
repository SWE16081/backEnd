<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/4/8
 * Time: 14:28
 */

namespace App\Controller;

/**
 * Class IndexController
 * @Controller(prefix="index")
 */
class IndexController
{
    /**
     *@RequestMapping(router="index")
     */
    public  function index(){
        echo "控制器方法";
    }
}
