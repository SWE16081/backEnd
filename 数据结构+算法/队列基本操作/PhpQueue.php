<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/8/14
 * Time: 9:28
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;


/** 循环队列
 * Class PhpQueue
 * @package App\Http\Controllers
 */
class PhpQueue
{
    protected $front;//
    protected $rear;
    protected $size;//队列最大长度
    protected $data;

    /** 初始化空队列
     * PhpQueue constructor.
     */
    function __construct($size)
    {
        //一开始将队首 队尾指针指向队列长度前一个
        $this->size=$size;
        $this->front=$this->size-1;
        $this->rear=$this->size-1;
    }
    //x入队
    function  enQueue($x){
        //入队前判断队列是否未满
        if($this->rear+1==$this->front){
           return "队列已满，出现溢出";
        }
        $this->rear=($this->rear+1)%$this->size;//取余防止溢出
        $this->data[$this->rear]=$x;
    }
    //出队
    function deQueue(){
        //出队前要判断队列是否为空
        if($this->rear==$this->front){
            return "队列为空";
        }
        $this->front=($this->front+1)%$this->size;//取余防止溢出
        return $this->data[$this->front];
    }
    //获取对头元素
    function getQueue(){
        //判断队列是否为空
        if($this->rear==$this->front){
            return "队列为空";
        }
        return  $this->data[($this->front+1)%$this->size];
    }
    //打印队列
    function  myPrint(){
        $m=$this->front;
        $n=$this->rear;
        while ($n!=$m){
            $m=($m+1)%$this->size;
            Log::info($this->data[$m]);
        }
    }
    function isEmpty(){
        if($this->rear==$this->front){
            return true;
        }else{
            return false;
        }
    }
}