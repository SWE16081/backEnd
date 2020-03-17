<?php
namespace app\index\controller;
// 引入系统数据类
use think\Db;
// 引入系统控制器类
use think\Controller;
class Index extends Controller
{
    public function index()
    {
    	// return "我们的浩哥哥好帅";

    	// 从数据库中读取数据

    	$data=Db::table('user')->select();

    	// 分配数据给页面

    	$this->assign('data',$data);

    	// 加载页面

    	return view();


    }
}
