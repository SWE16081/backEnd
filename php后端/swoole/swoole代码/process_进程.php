<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2021/2/1
 * Time: 16:30
 */


use Swoole\Process;
$a=0;
for ($n = 1; $n <= 10; $n++) {
    $process = new Process(function () use (&$a) {
        //子进程 业务逻辑代码
            sleep(10);
            $a++;
            echo getmypid()."正在执行任务".PHP_EOL;
    });
    $process->start();//启动进程
}

//回收子进程
while( $status = Process::wait(true)){
    echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
}
var_dump($a);
//外面的代码是主进程，process是子进程，是独立的内存空间