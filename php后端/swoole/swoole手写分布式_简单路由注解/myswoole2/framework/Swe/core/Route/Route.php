<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/4/9
 * Time: 14:22
 */

namespace Swe\core\Route;


class Route
{
    /**
     * @var
     * Get=>[
     *   routePath=>'/index/test',
     *   handle=>'App/IndexController@index',
     */
    private  static $route;
    /**
     * 添加路由
     * @author xichao<952002423@qq.com>
     */
   public static function addRoute($method,$routeInfo){
       self::$route[$method][]=$routeInfo;
   }

    /**
     * 分发路由
     * @author xichao<952002423@qq.com>
     */
   public static function diapatchRoute($method,$pathInfo){
//       var_dump(self::$route);
//       var_dump('123',$pathInfo);
       switch ($method){
           case 'GET':
               foreach(self::$route[$method] as $v){
                   //判断路径是否在注册路由上
                   if($pathInfo==$v['routeInfo']){
                       $handle=explode('@',$v['handle']);
                       $class=$handle[0];
                       $method=$handle[1];

                     return  (new $class)->$method();break;
                   }

               }
               break;
           case 'POST':
               break;
       }
   }

}
