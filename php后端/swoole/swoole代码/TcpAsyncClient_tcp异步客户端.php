<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/2/24
 * Time: 11:52
 */
//异步客户端
$client=new Swoole\Client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);


$server->on('Connect',function($server,$fd){
    echo"连接客户端成功\n";

});

$server->on('Receive',function($server,$fd,$form_id,$data){
    echo "接收客户端数据:{$data}\n";
    $server->send($fd,"sever{$data}");
});
$server->on('Close',function($server,$fd){
    echo "客户端关闭";
});

