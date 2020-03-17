<?php 
namespace app\index\controller;
// 导入系统控制器

use think\Controller;

use think\Cookie;

class Cookies extends Controller{

	// 设置cookie方法

	public function  setCookie(){

		Cookie::set('name','云知梦');
		Cookie::set('info','云知梦只为有梦想的人',50);

		cookie('time','2017-10-25');
		cookie('age',5,50);
	}

	// 获取Cookie

	public function getCookie(){
		dump(Cookie::get('name'));
		dump(Cookie::get('info'));
		dump(cookie('time'));
		dump(cookie('age'));
	}

	// 判断Cookie是否设置

	public function isCookie(){
		dump(Cookie::has('name'));
		dump(Cookie::has('info'));

		dump(cookie("?time"));
		dump(cookie("?age"));
	}

	// 删除Cookie

	public function delCookie(){

		dump(Cookie::delete('name'));
		dump(cookie('time',null));
	}

	// 清空Cookie

	public function clearCookie(){

		Cookie::clear();

		cookie(null);
	}
}



 ?>