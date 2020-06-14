<?php
namespace app\index\controller;

use think\Controller;

use think\Db;

use think\Cache;

use think\Session;

class Index extends Controller
{	
    // 前台首页
	public function index(){

		// 从数据库中读取数据

		$data=Db::table('user')->select();

		// 设置缓存

			// dump(Cache::set('UserData',$data));
			// dump(Cache::set('UserData',$data,200));
			// dump(cache('data',$data,200));


		// 读取缓存


			dump(Cache::get('UserData'));
			// dump(cache('UserData'));
			// dump(cache('abc'));

		// 删除缓存
			// dump(Cache::get('UserData'));
			// dump(Cache::rm('UserData'));
			// cache('UserData',NULL);	


		// 清空缓存

			dump(Cache::clear());


    }

    // 缓存的使用

    public function huancun(){

    	// 从缓存中获取数据

    	if ($data=cache('UserData')) {
    	
    		// 如果数据存在

    		echo "1111111";

    		
    	}else{
    		echo "222222222";
    		// 如果缓存中没有数据
    		$data=Db::table('User')->select();

    		cache('UserData',$data,20);
    	}


    	// 分配数据

    	$this->assign('data',$data);

    	// 加载页面

    	return $this->fetch();

    }

    // 设置SESSION

    public function setSession(){

    	// Session::set('name','云知梦');

    	// dump(session('age','4'));

    	$data=array(
    		'name'=>'浩哥',
    		"info"=>"云知梦一哥",
    		"age"=>18
    		);

    	dump(session("data",$data));

    }


    // 获取SESSION
    public function getSession(){

    	// dump(Session::get('name'));

    	dump(session('age'));

    	dump(session('data'));
    }

    // 判断sessin

    public function pSession(){

    	dump(Session::has('name1'));
    	dump(session("?name"));
    }

    // 删除session

    public function delSession(){

    	// dump(Session::delete('data'));
    	// dump(session('name',null));

    	Session::clear();

    	session(null);
    }
}
