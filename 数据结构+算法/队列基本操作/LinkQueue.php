<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/8/14
 * Time: 11:18
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

/**链队列
 * 加了一个头结点 和一个尾指针
 * Class LinkQueue
 * @package App\Http\Controllers
 */
class LinkQueue
{
    protected $front,$rear;
    function __construct()
    {
        $queueNode=new QueueNode(null,null);
        $this->front=$queueNode;
        $this->rear=$queueNode;
    }
    //入队
    function enQueue($x){
        $s=new QueueNode($x,null);
        $this->rear->next=$s;
        $this->rear=$s;
    }
    //出队
    function deQueue(){
        if($this->front==$this->rear) {
            return "队列已空";
        }
            $p=$this->front->next;
            $x=$p->data;
            $this->front->next=$p->next;
            if($p->next==null){
                $this->front=$this->rear;
                return "队列已空";
            }
            return $x;

    }
    //获取对首元素
    function getQueue(){
        $p=$this->front->next;
        if($this->front==$this->rear){
            return '此队列已空';
        }
        return $p;
    }
    //遍历
    function  myPrint(){
        $p=$this->front->next;
        while($p->next!=null){
            Log::info('队列的值:'.$p->data);
            $p=$p->next;
        }
    }
    function isEmpty(){
        if($this->front==$this->rear){
            return true;
        }else{
            return false;
        }
    }
}