<?php 
// 声明命名空间

namespace app\index\controller;

// 导入系统控制器类

use think\Controller;


use think\Db;

// 声明控制器

class User extends Controller{

	// 增

	public function insert(){

		// 执行查询语句
		// 返回值 影响行数

		$data=Db::execute("insert into user value(null,'user1','123','18')");
		$data=Db::execute("insert into user value(null,?,?,?)",['user2','456','20']);
		$data=Db::execute("insert into user value(null,:name,:pass,:age)",['name'=>"user3","pass"=>'678','age'=>25]);

		dump($data);
	}

	// 删除

	public function delete(){

		// 返回值 影响行数
		$data=Db::execute("delete from user where id=10");
		$data=Db::execute("delete from user where id>?",[15]);
		$data=Db::execute("delete from user where id>:id",["id"=>10]);

		dump($data);
	}

	// 改

	public function update(){

		$data=Db::execute("update user set age='20' where id=9");

		dump($data);
	}

	// 查

	public function select(){

		// 查询数据
			// 使用系统类
			$data=Db::query("select * from user");

			// dump($data);

			$data=Db::query("select * from user where  id >=? and id<=?",[5,3]);

			dump($data);
			// 获取执行的sql语句

			echo Db::getLastSql();


	}
}

 ?>