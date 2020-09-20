<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class test extends Controller
{
    //
    public function treeTest(){

        $binaryTree=new BinaryTree();;
        $binaryTree->add(6);
        $binaryTree->add(4);
        $binaryTree->add(8);
        $binaryTree->add(3);
        $binaryTree->add(5);
        $binaryTree->add(7);
        $binaryTree->add(9);
//        $binaryTree->add(3);
//        $binaryTree->add(4);
//        $binaryTree->add(5);
//        $binaryTree->add(6);
//        $binaryTree->add(7);
//        $binaryTree->add(8);
//        $binaryTree->add(9);
//        Log::info('前序遍历');
//        $binaryTree->preOrderSel();
//        Log::info('中序遍历');
//        $binaryTree->inOrderSel();
//        Log::info('后序遍历');
//        $binaryTree->postOrderSel();
//        Log::info('层序遍历');
//        $binaryTree->leverOrder();
        Log::info('层序遍历2');
        $binaryTree->leverOrder2();
        return 'asd';
    }
    public function queueTest(){
        $phpQueue=new PhpQueue(10);
        $phpQueue->enQueue(1);
        $phpQueue->enQueue(3);
        $phpQueue->enQueue(4);
        $phpQueue->enQueue(6);
        $phpQueue->enQueue(18);
        echo  $phpQueue->getQueue();
        $phpQueue->myPrint();
        Log::info('出队');
        $phpQueue->deQueue();
        $phpQueue->deQueue();
        $phpQueue->myPrint();
        return "2342";
    }
    public function linkQueue(){
        $linkQueue=new LinkQueue();
        $linkQueue->enQueue(1);
        $linkQueue->enQueue(3);
        $linkQueue->enQueue(4);
        $linkQueue->enQueue(6);
        $linkQueue->enQueue(18);
        $linkQueue->myPrint();
        Log::info('出队');
        $linkQueue->deQueue();
        $linkQueue->deQueue();
        $linkQueue->myPrint();
        return "2342";
    }
}
