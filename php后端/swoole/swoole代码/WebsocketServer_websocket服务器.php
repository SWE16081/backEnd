<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/3/25
 * Time: 14:12
 */
$websocket=new Swoole\Websocket\Server('0.0.0.0',9510);
//客户端与服务器建立连接回调此函数
$websocket->on('open',function ($server,$request){
    print_r($request->fd);
    echo "客户端建立连接";
});
//当服务器收到客户端数据会回调此函数
$websocket->on('message',function (Swoole\WebSocket\Server $server, $frame){
    echo "接收到客户端数据 {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "服务器向客户端推送数据");
});
$websocket->on('close',function ($ws,$fd){
    echo "客户端{{$fd}}关闭连接";
});
$websocket->start();