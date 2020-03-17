<?php 
// 声明命名空间

namespace app\index\controller;

use think\Controller;
// 声明控制器

class Error extends Controller{
	// index

	public function index(){
		$this->redirect('index/index');
	}

	// 空操作

	public function _empty(){
		$this->redirect('index/index');
		
	}
}




