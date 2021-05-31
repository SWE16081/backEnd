<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/2/23
 * Time: 14:47
 */
//同步阻塞客户端
//创建client对象
$client = new Swoole\Client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);
if(!$client->connect('0.0.0.0',9503,-1)){
    exit('连接失败'.$client->errCode);
}
//向服务器发送远程服务器
$client->send('客户端向服务器发送数据');
//从服务器接收数据
echo "接收服务端数据:".$client->recv();
//关闭连接
$client->close();