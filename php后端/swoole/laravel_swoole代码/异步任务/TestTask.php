<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/4/6
 * Time: 16:47
 */
namespace App\Http\Controllers;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Log;

class TestTask extends Task{

    private $data;
    private $result;
    public function __construct($data)
    {
        $this->data = $data;
    }
    // 处理任务的逻辑，运行在Task进程中，不能投递任务
    public function handle()
    {
        Log::info(__CLASS__ . ':handle start', [$this->data]);
        sleep(2);// 模拟一些慢速的事件处理
        // 此处抛出的异常会被上层捕获并记录到Swoole日志，开发者需要手动try/catch
        $this->result = 'the result of ' . $this->data;
    }
    // 可选的，完成事件，任务处理完后的逻辑，运行在Worker进程中，可以投递任务
    public function finish()
    {
        Log::info(__CLASS__ . ':finish start', [$this->result]);
//        Task::deliver(new TestTask2('task2')); // 投递其他任务
    }
}
