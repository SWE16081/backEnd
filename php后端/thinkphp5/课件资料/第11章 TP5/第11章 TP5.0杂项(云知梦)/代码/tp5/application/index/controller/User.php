<?php 
// 声明命名空间
namespace app\index\controller;

// 导入系统类

use think\Controller;

use think\Db;

use think\Request;

// 声明控制器
class User extends Controller{

	// 首页方法

	public function index(){

		// 查询数据

		$data=Db::table('user')->paginate(3,true);

		// 分配数据

		$this->assign('data',$data);

		// 加载页面

		return $this->fetch();
	

	}

	// 文件的上次页面

	public function add(){

		return $this->fetch();
	}

	// 文件上传方法

	public function upload(Request $request){

		// 接收数据

		$file=$request->file('file');

		// 进行文件上传

		if ($info=$file->move('./upload/')) {
			# code...
			dump($info->getsaveName());
		}else{
			dump($info->getError());
		}
	}

	// 多文件上传

	public function adds(){
		return $this->fetch();
	}

	// 多文件处理方法

	public function uploads(Request $request){

		// 获取用户上传信息

		$files=$request->file('file');

		// 多文件处理

		foreach ($files as $file) {
			# code...
			if ($info=$file->move('./upload/')) {
				# code...
				dump($info->getsaveName());
			}else{
				dump($info->getError());
			}
		}
	}
}


 ?>