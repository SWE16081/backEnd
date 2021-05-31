<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/2/3
 * Time: 9:59
 */
//创建server对象 ,0.0.0.0开放给任意客户端，开放给具体某个客户端，填写其ip,开放给内网服务ip为127.0.0.1
$server=new Swoole\Server('0.0.0.0',9503);
//混合udp\tcp，同时监听内网和外网端口

//设置运行时参数
//$server->set(array(
//    'daemonize'=>true,//程序将转入后台作为守护进程运行。长时间运行的服务器端程序必须启用此项 默认为false
//));

//注册事件回调
$server->on('Connect',function($server,$fd){
    echo"连接服务端成功\n";

});

$server->on('Receive',function($server,$fd,$form_id,$data){
    echo "接收客户端数据:{$data}\n";
    $server->send($fd,"sever{$data}");

});
$server->on('Close',function($server,$fd){
    echo "服务端关闭";
});

//启动服务器
$server->start();

