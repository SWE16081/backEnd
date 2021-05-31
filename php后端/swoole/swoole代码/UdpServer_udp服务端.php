<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/2/24
 * Time: 13:33
 */
//udp服务端

$server=new Swoole\Server('0.0.0.0',9504,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

//监听数据接收事件
//udp没有连接的概念，因此启动服务后，客户端无需Connect,可以直接向server监听的端口发送数据包，对应的事件为onPacket
$server->on('Packet', function ($server, $data, $clientInfo) {
    echo '接收客户端数据:'.$data;
    //基于ip+端口发送信息
    $server->sendto($clientInfo['address'], $clientInfo['port'], "Server：{$data}");
});

//启动服务器
$server->start();