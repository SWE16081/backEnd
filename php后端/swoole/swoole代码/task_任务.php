<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/3/26
 * Time: 14:01
 */
$server=new Swoole\Server('0.0.0.0','9510');
//设置异步任务的工作进程数量
$server->set([
   'task_worker_num'=>4
]);
//此回调函数在worker进程中执行
$server->on('Receive',function ($server,$task_id,$data){
    //投递异步任务
    $task__id=$server->task($data);
    echo "投递异步任务id:{$task_id} \n";
});
//处理异步 任务 此调函数在task进程中
$server->on('Task',function ($server,$task_id, $reactor_id, $data){
    echo "行的任务id [id={$task_id}]".PHP_EOL;
    //返回任务执行的结果
    $server->finish("{$data} -> OK");
});

//处理异步任务的结果(此回调函数在worker进程中执行)
$server->on('Finish', function ($server, $task_id, $data) {
    echo "任务[{$task_id}] 结束: {$data}".PHP_EOL;
});

$serv->start();
