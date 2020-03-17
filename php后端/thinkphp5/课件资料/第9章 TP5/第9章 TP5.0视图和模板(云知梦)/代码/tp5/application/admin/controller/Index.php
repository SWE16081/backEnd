<?php 
// 声明命名空间
namespace app\admin\controller;

// 导入类
use think\Controller;
// 声明控制器

class Index extends Controller{

	// 后台首页方法

	public function index(){

		return $this->fetch();
	}
}


 ?>