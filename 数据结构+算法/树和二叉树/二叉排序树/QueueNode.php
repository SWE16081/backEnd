<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/8/14
 * Time: 11:16
 */

namespace App\Http\Controllers;

/**
 * 队列节点
 * Class QueueNode
 * @package App\Http\Controllers
 */
class QueueNode
{
    public  $data,$next;
    function __construct($data,$next)
    {
        $this->data=$data;
        $this->next=$next;
    }
}