<?php 
// 声明命名空间
namespace app\index\controller;

use think\View;

use think\Controller;
// 声明控制器
class User extends Controller
{

	// 控制器的初始化方法
	public function _initialize(){
		echo "我是初始化方法";
	}
	// 声明方法

	public function index(){

		return "我是User控制器下的index方法";
	}


	// 加载页面

	public function jiazai(){

		// 实例化系统view类

			// $view=new \think\View;
			// return $view->fetch();

			// $view=new View();

			// return $view->fetch();


		// 使用系统控制器方法

			return $this->fetch();
		// 使用系统函数
		// return view();
	}

	// 数据的输出

	public function shuchu(){

		// 输出字符串

			// return "云知梦";

		// 输出数组

			$arr=array(
				'name'=>'浩哥',
				'age'=>18
				);

			return $arr;

		// 返回一段html代码

	}
}

