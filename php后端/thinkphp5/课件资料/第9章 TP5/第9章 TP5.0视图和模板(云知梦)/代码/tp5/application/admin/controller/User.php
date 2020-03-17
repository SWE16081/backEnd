<?php 
// 声明命名空间
namespace app\admin\controller;

// 导入类
use think\Controller;
// 声明控制器

class User extends Controller{

	// 用户展示方法

	public function index(){

		return $this->fetch();
	}

	// 用户添加方法
	public function add(){

		return $this->fetch();
	}

	// 用户修改方法
	public function edit(){

		return $this->fetch();
	}
}


 ?>