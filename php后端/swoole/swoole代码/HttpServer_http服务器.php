<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/3/16
 * Time: 16:16
 */
//http服务器
$http=new Swoole\Http\Server('0.0.0.0',9510);

$http->on('Request',function ($request,$response){
    //获取请求头
//    var_dump( $request->header);页面上显示
    $response->header('Content-Type','text/html;charset=utf-8');
    //设置cookie值
    $response->cookie('test',123,time()+1800);
    $response->end('http服务器访问成功'.json_encode($request->cookie['test']));
    //获取get参数
//    var_dump($request->get);
    //获取cookie
    $request->cookie['test'];
});
$http->start();

