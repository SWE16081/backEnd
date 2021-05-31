<?php

/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/3/25
 * Time: 14:58
 */
class ws
{
    protected $ws;
    public function __construct()
    {
        $this->ws=new Swoole\Websocket\Server('0.0.0.0',9510);
        $this->ws->on('open',[$this,'onOpen']);//[$this,'onOpen']等价于$this->>onOpen()
        $this->ws->on('message',[$this,'onMessage']);//关于swoole回调函数的执行
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
    }
    public function onOpen($ws,$request){
        var_dump($request->fd);
    }
    public function onMessage($ws,$frame){
        echo "客户端发送的数据{$frame}";
        $ws->push($frame->fd,'客户端连接服务器成功');
    }
    public function onClose($ws,$fd){
        echo"客户端:{$fd}关闭";
    }
}
$object=new ws();