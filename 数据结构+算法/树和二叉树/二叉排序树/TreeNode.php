<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/8/11
 * Time: 19:35
 */

namespace App\Http\Controllers;


class TreeNode
{
    public $data;
    public $leftchild=null;
    public $rightchild=null;
    function __construct($data)
    {
        $this->data=$data;
        $this->leftchild=null;
        $this->rightchild=null;
    }
}