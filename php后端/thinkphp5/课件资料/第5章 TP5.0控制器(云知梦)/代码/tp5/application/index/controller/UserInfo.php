<?php 
// 声明命名空间
namespace app\index\controller;

use think\Controller; 
// 声明控制器
class UserInfo extends Controller{

	// 前置方法属性

	protected $beforeActionList=[
		'one',
		// 不想让谁使用前置方法two
		'two'=>['except'=>"index"],
		// 仅仅可以让谁使用前置方法three
		'three'=>['only'=>'index'],

	];
	// one

	public function one(){

		echo "one<hr>";
	}

	// two
	public function two(){

		echo "two<hr>";
	}

	// three
	public function three(){

		echo "three<hr>";
	}

	// 声明方法

	public function index(){

		return "我是UserInfo控制器下的index方法";
	}

	public function index1(){

		return "我是UserInfo控制器下的index1方法";
	}
}

