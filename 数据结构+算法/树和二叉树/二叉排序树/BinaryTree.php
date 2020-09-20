<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/8/11
 * Time: 19:39
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;

class BinaryTree
{


    public  $root;
    public function addRecursive($current,$data){
        if($current==null){
            return new TreeNode($data);
        }
        if($data<$current->data){
            $current->leftchild=$this->addRecursive($current->leftchild,$data);
        }
        else if($data>$current->data){
            $current->rightchild=$this->addRecursive($current->rightchild,$data);
        }else{
            //插入值和当前节点值相同 去掉相同值
            return $current;
        }
        return $current;
    }
    //添加
    public function add($data){
       $this->root= $this->addRecursive($this->root,$data);
    }

    //深度优先搜索
    //前序遍历
    public function preOrder($treeNode){
        if($treeNode==null)
            return ;
        else{
            Log::info('二叉树的值：'.$treeNode->data);
            $this->preOrder($treeNode->leftchild);
            $this->preOrder($treeNode->rightchild);
        }

    }
    public function preOrderSel(){
        $this->preOrder($this->root);
    }

    //中序遍历  深度优先搜索
    public function inOrder($treeNode){

        if($treeNode!=null)
        {
            $this->inOrder($treeNode->leftchild);
            Log::info('二叉树的值：'.$treeNode->data);
            $this->inOrder($treeNode->rightchild);
        }
    }
    public function inOrderSel(){
        $this->inOrder($this->root);
    }
    //深度优先搜索
    //后序遍历
    public function postOrder($treeNode){
        if($treeNode!=null)
      {
            $this->postOrder($treeNode->leftchild);
            $this->postOrder($treeNode->rightchild);
            Log::info('二叉树的值：'.$treeNode->data);
        }

    }
    public function postOrderSel(){
        $this->postOrder($this->root);
    }
    //广度优先搜索 层序遍历 循环队列
    public function leverOrder(){
        if($this->root==null){
            return "二叉树为空树";
        }
         $phpQueue=new PhpQueue(7);
        $phpQueue->enQueue($this->root);
        while(!$phpQueue->isEmpty()){//队列不为空
            $p=$phpQueue->getQueue();
            Log::info('二叉树的值：'.$p->data);
            $phpQueue->deQueue();
            if($p->leftchild!=null){
                $phpQueue->enQueue($p->leftchild);
            }
            if($p->rightchild!=null){
                $phpQueue->enQueue($p->rightchild);
            }
        }

    }
    //广度优先搜索 层序遍历 链队列
    public function leverOrder2(){
        if($this->root==null){
            return "二叉树为空树";
        }
        $linkQueue=new LinkQueue();
        $linkQueue->enQueue($this->root);
//        print_r($linkQueue->isEmpty());die;
        while(!$linkQueue->isEmpty()){//队列不为空
            $p=$linkQueue->getQueue()->data;
            Log::info('二叉树的值：'.$p->data);
            $linkQueue->deQueue();
            if($p->leftchild!=null){
                $linkQueue->enQueue($p->leftchild);
            }
            if($p->rightchild!=null){
                $linkQueue->enQueue($p->rightchild);
            }
        }
    }
    //删除元素
    public function deleteRecursive($current,$data){
        if($current==null){
            return new TreeNode($data);
        }
        if($data<$current->data){
            $current->leftchild=$this->deleteRecursive($current->leftchild,$data);
        }
        else if($data>$current->data){
            $current->rightchild=$this->deleteRecursive($current->rightchild,$data);
        }else{
            //删除值和当前节点值相同
            //没有子节点
            if ($current->leftchild == null && $current->rightchild == null) {
                return null;
            }
            //有一个左子节点
            if($current->leftchild == null){
                return $current->rightchild;
            }
            //有一个右子节点
            if($current->rightchild==null){
                return $current->leftchild;
            }
            //有左右子节点

        }
        return $current;
    }
    public function deleteRecursiveSel($data){
        $this->root=$this->deleteRecursive($this->root,$data);

    }
    public function selRecursive($current,$data){

    }
    public function sel(){

    }
}