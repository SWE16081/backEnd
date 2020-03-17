<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 引入系统类
use think\Route;

// 定义路由规则
// 路由的基本形式
	// Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');
	// 静态路由
	Route::rule('/','index/index/index');
	// Route::rule('test','index/index/test');
	// 带参数路由
	Route::rule('course/:id','index/index/course');
	// Route::rule('time/:year/:month','index/index/shijian');
	// 可选参数的路由
	// Route::rule('time/:year/[:month]','index/index/shijian');
	// 全动态路由
	// Route::rule(':a/:b','index/index/dongtai');
	// 完全匹配路由
	// Route::rule('test1$','Index/index/test1');
	// 带额外参数
	// Route::rule('test2','Index/index/test2?id=10&name=zhangsan');

// 设置路由的请求方式
	// 默认支持所有请求方式
	// 支持get请求
		// Route::rule('type','Index/index/type','get');
		// Route::get('type','Index/index/type');

	// 支持post请求
		// Route::rule('type','Index/index/type','post');
		// Route::post('type','Index/index/type');

	// 同时支持get和post
		// Route::rule('type','Index/index/type','get|post');

	// 支持所有路由
		// Route::rule('type','Index/index/type','*');
		// Route::any('type','Index/index/type');

	// 支持put请求

		// Route::rule('type','Index/index/type','put');
		// Route::put('type','Index/index/type');


	// 支持delete请求

		// Route::rule('type','Index/index/type','delete');
		// Route::delete('type','Index/index/type');

// 动态批量注册路由
	// Route::rule([
	// '路由规则1'=>'路由地址和参数',
	// '路由规则2'=>['路由地址和参数','匹配参数（数组）','变量规则（数组）']
	// ...
	// ],'','请求类型','匹配参数（数组）','变量规则');

	// Route::rule([
	// 	"test"=>"index/index/test",
	// 	"course/:id"=>"index/index/course"

	// ],'','get');

	// Route::get([
	// 	"test"=>"index/index/test",
	// 	"course/:id"=>"index/index/course"

	// 	]);

// 使用配置文件批量注册

	// return [
	// 	"test"=>"index/index/test",
	// 	"course/:id"=>"index/index/course"
	// ];

// 变量规则
	// Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');

	// Route::rule("course/:id","index/index/course",'get',[],['id'=>'\d{1,3}']);


// 路由参数
	// Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');
	// Route::rule("course/:id","index/index/course",'get',['method'=>'get','ext'=>'html'],['id'=>'\d{1,3}']);
	// 路由参数method 请求方式必须是get
	// 路由参数ext 主要设置路由的后缀

// 声明资源路由
	
	// Route::resource('blog','Index/blog');

// 声明快捷路由
	
	// Route::controller('blog','Index/blog');

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
