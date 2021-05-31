<?php

namespace App\Http\Controllers;
use App\Http\Controllers\controller;
//use Illuminate\Http\Request;
use Hhxsv5\LaravelS\Swoole\Task\Task;

class TestController extends Controller
{
    //websocket 控制器推送数据
    public function pushMessage(){
//
//        $fd=1;
//        $swoole=app('swoole');
//        $success = $swoole->push($fd, 'Push data to fd#1 in Controller');//返回bool值
//        return '132';
//        var_dump($success);

        $task = new TestTask('task data');
        var_dump("aa");
        // $task->delay(3); // 延迟3秒投递任务
        // $task->setTries(3); // 出现异常时，累计尝试3次
        $ret = Task::deliver($task);
        var_dump($ret);// 判断是否投递成功
    }

    public function test(){
        return "123";
    }
}
