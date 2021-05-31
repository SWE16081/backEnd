<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/2/24
 * Time: 13:59
 */
//UDP客户端
//创建client对象
$client = new Swoole\Client(SWOOLE_SOCK_UDP,SWOOLE_SOCK_SYNC);

//向服务器发送远程服务器
$client->sendTo('0.0.0.0',9504,'UDP客户端向UDP服务器发送数据');
//从服务器接收数据
echo "接收服务端数据:".$client->recv();
//关闭连接
$client->close();
