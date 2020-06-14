<?php
namespace app\index\controller;

use think\Controller;

use think\Db;

use think\Validate;
class Index extends Controller
{	
	// 增加管理员页面
    public function index()
    {

    	return $this->fetch();
    }

    // 处理管理员的添加
    public function insert(){

    	// 获取数据

    	$data=input('post.');

    	// 判断用户名是否存在

    	if ($data['username']) {
    		// 判断用户名的长度

    		$size=strlen($data['username']);

    		if ($size>=6 && $size<=12) {

    			// 判断是否输入密码

    			if ($data['password']) {
    				# code...
    				// 判断两次密码是否一致

    				if ($data['password']==$data['repassword']) {
    					# code...

    					$arr['username']=$data['username'];
    					$arr['password']=md5($data['password']);
    					$arr['time']=time();
    					$arr['status']=$data['status'];


    					if (Db::table('admin')->insert($arr)) {
    						# code...
    						$this->success('添加成功');
    					}else{
    						$this->error('添加失败');

    					}

    				}else{
    					$this->error("两次密码不一致");
    				}
    			}else{
    				$this->error("密码不存在");
    			}

    		}else{
    			$this->error("用户名不在6-12位之间");
    		}
    	}else{

    		$this->error("请输入用户名");
    	}


    }

    // 数据添加处理集合验证器

    public function insert_yzq(){

    	// 实例化验证器类

    	$validate=new Validate(
    		[

    		"username"=>"require|length:6,12",
    		"password"=>"require|confirm:repassword"

    		],
    		[
    		"username.require"=>'用户名不存在',
    		"username.length"=>'用户名长度不满足',
    		"password.require"=>'密码不存在',
    		"password.confirm"=>'两次密码不一致',

    		]

		);

    	// 接收用户提交的数据

    	$data=input("post.");

    	// 进行验证

    	if ($validate->check($data)) {
    		# code...

	    	$arr['username']=$data['username'];
	    	$arr['password']=md5($data['password']);
	    	$arr['time']=time();
	    	$arr['status']=$data['status'];


	    	if (Db::table('admin')->insert($arr)) {
	    		# code...
	    		$this->success('添加成功');
	    	}else{
	    		$this->error('添加失败');

	    	}
    	}else{
    		dump($validate->getError());
    	}

    }

    // 验证器

    public function insert1(){

    	// 接收数据

    	$data=input('post.');

    	// 实例化验证器

    	$validate=new \app\index\validate\Admin;

    	// 进行数据验证

    	if ($validate->check($data)) {
    		# code...
    	}else{
    		dump($validate->getError());
    	}

    }
}
