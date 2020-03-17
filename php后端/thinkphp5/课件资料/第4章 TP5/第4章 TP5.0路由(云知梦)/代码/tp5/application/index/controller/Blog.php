<?php 
namespace app\index\controller;

use think\Url;
class Blog{
	public function  index(){
		// 普通url地址
		dump(Url::build('index/index/index'));

		dump(url('index/index/index'));

		dump(url('index/index/test'));
		dump(Url::build('index/index/test'));
		dump(Url::build('index/index/course/id/10'));
		dump(Url('index/index/course/id/10'));
		// 带参数url
		dump(url('index/index/abc',['id'=>10,'name'=>"张三"]));
		dump(url('index/index/abc','id=10&name=100'));
		// string(45) "/index/abc/id/10/name/%E5%BC%A0%E4%B8%89.html"
		// string(30) "/index/abc/id/10/name/100.html"
		// 带锚点
		dump(url('index/index/abc#name',['id'=>10,'name'=>"100"]));
		// string(35) "/index/abc/id/10/name/100.html#name"
		// 带域名

		dump(url('index/index/abc#name@blog',['id'=>10,'name'=>"100"]));
		// string(53) "http://blog.tp.com/index/abc/id/10/name/100.html#name"

		// 加入口文件
		Url::root('/index.php');
		dump(url('index/index/abc#name@blog',['id'=>10,'name'=>"100"]));
		// string(63) "http://blog.tp.com/index.php/index/abc/id/10/name/100.html#name"





	}

	public function geta(){
		echo "AAAAAAAA";
	}
}