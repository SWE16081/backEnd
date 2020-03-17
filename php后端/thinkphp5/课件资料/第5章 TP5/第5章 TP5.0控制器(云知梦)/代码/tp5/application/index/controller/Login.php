<?php 
// 声明命名空间

namespace app\index\controller;

// 引入系统控制器

use think\Controller;
// 声明控制器

class Login extends Controller{

	// 登录页面

	public function index(){

		// 加载登录页面

		return view();
	}

	// 处理登录的提交页面

	public function check(){

		// 接收数据

		$username=$_POST['username'];
		$password=$_POST['password'];
		
		// 判断是否登录成功

		if ($username=="admin" && $password=="123") {
			// 成功之后跳转
			// $this->success(提示信息,跳转地址,用户自定义数据,跳转跳转,header信息);
			// 跳转地址未设置时 默认返回上一个页面
			$this->success('跳转成功',url('index/index'));

		}else{
			// 失败之后跳转

			$this->error('登录失败');
		}
	}	


	// 重定向

	public function cdx(){

		$this->redirect('index/index',['id'=>100,'name'=>'abc']);
	}

	// 空操作

	public function _empty(){
		$this->redirect('index/index');

	}
}



