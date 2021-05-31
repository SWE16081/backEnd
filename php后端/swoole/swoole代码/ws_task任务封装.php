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
        //new swoole 对象
        $this->ws=new Swoole\Websocket\Server('0.0.0.0',9510);

        //设置进程参数
        $this->ws->set([
            'worker_num'=>2,//worker进程
            'task_worker_num'=>4//task进程
        ]);
        //监听打开连接事件
        $this->ws->on('open',[$this,'onOpen']);//[$this,'onOpen']等价于$this->>onOpen()
        //监听消息连接事件
        $this->ws->on('message',[$this,'onMessage']);//关于swoole回调函数的执行
        //监听task事件
        $this->ws->on('task',[$this,'onTask']);//
        //监听finish事件
        $this->ws->on('finish',[$this,'onFinish']);//
        //监听连接关闭
        $this->ws->on('close',[$this,'onClose']);
        //启动服务器
        $this->ws->start();
    }
    public function onOpen($ws,$request){
        var_dump($request->fd);
    }
    public function onMessage($ws,$frame){
        echo "客户端发送的数据{$frame}";
        //发送一条数据
        $data=[
          'task'=>1,
          'fd'=>$frame->fd,
        ];
        //耗时10s
        $ws->task($data);
        $ws->push($frame->fd,'客户端连接服务器成功');
    }

    public function  onTask($ws,$task_id,$worker_id,$data){
        var_dump($data);
        sleep(10);
        return "on task finish";//告诉worker进程task已完成
    }
    //ontsak方法的返回值   不是上面的data数组
    public function onFinish($ws,$task_id,$data){
        echo"任务id:{$task_id}\n";
        echo "finish data success:{$data} \n";
    }
    public function onClose($ws,$fd){
        echo"客户端:{$fd}关闭";
    }
}
$object=new ws();