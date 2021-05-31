<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/4/8
 * Time: 14:26
 */

namespace Swe;


use App\Controller\IndexController;
use App\Controller\TestController;
use Swe\core\Route\Route;
use Swoole\Http\Server;
class App
{
    //
    public function run(){
        echo"运行应用".PHP_EOL;
        $this->init();//初始化
//        载入路由注解
        $this->loadAnnotations();

        //http服务器
        $http=new Server('0.0.0.0',9510);
        $http->on('Request',function ($request,$response){
            $response->header('Content-Type','text/html;charset=utf-8');
            $pathInfo=$request->server['path_info'];
//            var_dump('222',$pathInfo);
            $method=$request->server['request_method'];
            //匹配request中的路径
            $res=Route::diapatchRoute($method,$pathInfo);
            var_dump($res);
//            if($request['path_info']==""){//从注解中得到匹配信息
//                //执行控制器某个方法
//            }
            $response->end('http服务器访问成功:'.$res);
        });
        $http->start();
    }

    public function init(){
        define('ROOT_PATH',dirname(dirname(__DIR__)));//根目录
        define('APP_PATH',ROOT_PATH."/application");
    }
    public function loadAnnotations(){
        //文件遍历
        $dir=$this->tree(APP_PATH,'Controller');
        if(!empty($dir)){
            foreach ($dir as $file){
                //var_dump($file);//文件路径
                //将文件目录实例化
                $filename=explode('/',$file);
                $className=explode('.',end($filename))[0];
                //加载文件
                $file=file_get_contents($file,false,null,0,500);
                //匹配文件命名空间 \s表示空格 i同时匹配大小写字母 .匹配除换行符\n之外的任意字符
                preg_match('/namespace\s(.*)/i',$file,$namespace);
                //$namespace的值 "App\Controller;
                if(isset($namespace[1])){
                    //消除 命名空间中的空格 引号 分号  App\   Controller;
                    $namespace=str_replace(['"',';',' '],'',$namespace[1]);
                    $className=trim($namespace).'\\'.$className;
                    $obj=new $className;
                    $reflect=new \ReflectionClass($obj);
                    //类的注解
                    $classComment=$reflect->getDocComment();
                    //正则 匹配前缀
                    //匹配/@Controller/()括号里的内容
                    preg_match("/@Controller\((.*)\)/",$classComment,$prefix);
                    $prefix=str_replace("\"","",explode('=',$prefix[1])[1]);
//                var_dump('前缀：'.$prefix);
                    foreach ($reflect->getMethods() as $method){
                        $methodComment=$method->getDocComment();//方法注解
                        preg_match("/@RequestMapping\((.*)\)/",$methodComment,$sufffix);
                        $sufffix=str_replace("\"","",explode('=',$sufffix[1])[1]);

                        //注册到路由
                        $routeInfo=[
                            'routeInfo'=>'/'.$prefix.'/'.$sufffix,
                            'handle'=>$reflect->getName()."@".$method->getName()
                        ];
//                     var_dump($routeInfo);
                        Route::addRoute('GET',$routeInfo);
                    }
                }


            }
        }
    }

    //遍历文件
    public function tree($dir,$filter){
        $dirs=glob($dir.'/*');
        $dirFiles=[];
        foreach($dirs as $dir){
            if(is_dir($dir)){
                $res=$this->tree($dir,$filter);
                if(is_array($res)){
                    foreach ($res as $v){
                        $dirFiles[]=$v;
                    }
                }
            }else{
                //判断是否是控制器
                if(stristr($dir,$filter)){
                    $dirFiles[]=$dir;
                }

            }
        }
        return $dirFiles;
    }
}
