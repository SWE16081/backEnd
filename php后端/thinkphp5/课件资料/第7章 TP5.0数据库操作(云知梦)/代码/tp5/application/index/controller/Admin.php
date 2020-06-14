<?php 

namespace app\index\controller;

// 导入数据库类

use think\Db;
class Admin 
{

	// 插叙数据方法

	public function index(){

		// 查询数据

		// table
			// 查询所有数据
			// SELECT * FROM `user`
			$data=Db::table("user")->select();

			// 查询一条数据
			// SELECT * FROM `user` LIMIT 1
			$data=Db::table("user")->find();

		// name

			$data=Db::name("user")->select();
			$data=Db::name("user")->find();

			

		// 助手函数 db()

			# SELECT * FROM `user`
			$data=db("user")->select();

			# SELECT * FROM `user` LIMIT 1
			$data=db("user")->find();

			

		// 如何进行条件匹配

			// SELECT * FROM `user` WHERE `id` > 25
			$data=Db::table("user")->where("id",">",25)->select();
			// SELECT * FROM `user` WHERE ( `id` > 25 AND `id` < 28 )
			$data=Db::table("user")->where("id",">",25)->where("id","<",28)->select();
			// SELECT * FROM `user` WHERE `name` LIKE '%user1%'
			$data=Db::table("user")->where("name","like","%user1%")->select();
			// SELECT * FROM `user` WHERE `name` = 'user3' AND `pass` = 'qwe'
			$data=Db::table("user")->where("name","user3")->where("pass",'qwe')->select();

		// whereOr
			// SELECT * FROM `user` WHERE `id` <= 23 OR `id` >= 28
			$data=Db::table("user")->where("id","<=",23)->whereOr("id",">=",28)->select();
			
			// SELECT * FROM `user` WHERE `name` LIKE '%user1%' OR `name` LIKE '%user2%'
			$data=Db::table("user")->where("name","like","%user1%")->whereOr("name","like","%user2%")->select();

		// limit 截取数据
			// SELECT * FROM `user` LIMIT 5
			$data=Db::table("user")->limit(5)->select();
			// SELECT * FROM `user` LIMIT 5,5
			$data=Db::table("user")->limit(5,5)->select();


		// order()实现排序
			// SELECT * FROM `user` ORDER BY `id`
			$data=Db::table("user")->order("id")->select();

			// SELECT * FROM `user` ORDER BY `id` desc
			$data=Db::table("user")->order("id","desc")->select();


		// 设置查询字段

			// 设置查询字段
			// SELECT `name`,`pass` FROM `user`
			$data=Db::table("user")->field("name,pass")->select();
			$data=Db::table("user")->field(['name','pass'])->select();

			// 起别名
			// SELECT name uname,`pass` FROM `user`
			$data=Db::table("user")->field("name uname,pass")->select();
			$data=Db::table("user")->field(['name'=>"uname",'pass'])->select();

			// sql 的系统函数
			// SELECT count(*) as tot FROM `user`
			$data=Db::table("user")->field("count(*) as tot")->select();
			$data=Db::table("user")->field(['count(*)'=>"tot"])->select();

			// 排除字段
			// SELECT `id`,`age` FROM `user`
			$data=Db::table("user")->field("name,pass",true)->select();
			$data=Db::table("user")->field(["name",'pass'],true)->select();

			// SELECT * FROM `user` WHERE ( id > 25 and id <28 )
			$data=Db::table("user")->where("id > 25 and id <28")->select();

			// SELECT * FROM `user` WHERE `id` > 25 AND `name` = 'user10'
			$data=Db::table("user")->where(["id"=>[">",25],"name"=>'user10'])->select();
			// SELECT * FROM `user` WHERE ( `id` > 25 AND `id` < 28 )
			$data=Db::table("user")->where(["id"=>[">",25]])->where(['id'=>["<",28]])->select();

		// page方法

			// 1 5
			// 5 10
			// 10 15
			// 15 20

			// SELECT * FROM `user` LIMIT 5,5
			$data=Db::table("user")->page("1,5")->select();

		// 分组聚合
			// SELECT `pass`,count(*) tot FROM `user` GROUP BY pass
			$data=Db::table("user")->field("pass,count(*) tot")->group("pass")->select();

		// havig 过滤
			// 只能结合分组使用
			// SELECT `pass`,count(*) tot FROM `user` GROUP BY pass HAVING tot >=2
			$data=Db::table("user")->field("pass,count(*) tot")->having("tot >=2")->group("pass")->select();


		// 多表查询
			// select goods.*,type.name tname from type,goods where goods.cid=type.id
			$data=Db::query("select goods.*,type.name tname from type,goods where goods.cid=type.id");
			
			// 内联实现数据库链接
			// SELECT `goods`.*,type.name tname FROM `goods` INNER JOIN `type` `type` ON `goods`.`cid`=`type`.`id`
			$data=Db::table("goods")->field("goods.*,type.name tname")->join("type","goods.cid=type.id")->select();
			
			// 右链接
			// SELECT `goods`.*,type.name tname FROM `goods` RIGHT JOIN `type` `type` ON `goods`.`cid`=`type`.`id`
			$data=Db::table("goods")->field("goods.*,type.name tname")->join("type","goods.cid=type.id",'right')->select();

			// 左链接
			$data=Db::table("goods")->field("goods.*,type.name tname")->join("type","goods.cid=type.id",'left')->select();


		// 别名

			// SELECT `g`.*,t.name tname FROM `goods` `g` LEFT JOIN `type` `t` ON `g`.`cid`=`t`.`id`
			$data=Db::table("goods")->alias("g")->field("g.*,t.name tname")->join("type t","g.cid=t.id",'left')->select();

		// union 集合

			// SELECT `name` FROM `user` UNION select name from goods
			$data=Db::field("name")->table("user")->union("select name from goods")->select();

		// bind 绑定参数

			$id=input("id");

			// 建议不要使用原生的sql语句
			// $data=Db::execute("delete from user where id=$id");
			$data=Db::table("user")->where("id",":id")->bind(["id"=>[$id,\PDO::PARAM_INT]])->delete();

		// 统计数据
			// SELECT MAX(age) AS tp_max FROM `user` LIMIT 1
			$data=Db::table("user")->max("age");

			// SELECT MIN(age) AS tp_min FROM `user` LIMIT 1
			$data=Db::table("user")->min("age");

			// SELECT AVG(age) AS tp_avg FROM `user` LIMIT 1
			$data=Db::table("user")->avg("age");

			// SELECT SUM(age) AS tp_sum FROM `user` LIMIT 1
			$data=Db::table("user")->sum("age");

			// SELECT COUNT(age) AS tp_count FROM `user` LIMIT 1
			$data=Db::table("user")->count("age");

			
			echo Db::getLastSql();
			dump($data);
	}

	// 增加操作

	public function insert(){

		

		// 插入数据库

			// 数组中的字段名 必须和数据库中的字段名一致

			$data=[
				"name"=>"张三",
				"pass"=>"123",
				"age"=>18,
			];

			// $code=Db::table("user")->insert($data);
			// INSERT INTO `user` (`name` , `pass` , `age`) VALUES ('张三' , '123' , 18)
			// 返回值 影响行数

		// 插入多条数据

			// $data=[
			// 	[
			// 		"name"=>"张三1",
			// 		"pass"=>"123",
			// 		"age"=>15,
			// 	],
			// 	[
			// 		"name"=>"张三2",
			// 		"pass"=>"123",
			// 		"age"=>19,
			// 	],

			// ];

			// $code=Db::table("user")->insertAll($data);

			// 返回值 影响行数

		// 获取最后一次插入ID

			// $data=[
			// 	"name"=>"张三",
			// 	"pass"=>"123",
			// 	"age"=>18,
			// ];

			// $code=Db::table("user")->insertGetId($data);

			// 返回值最后插入的id


		// 助手函数
			// $data=[
			// 	"name"=>"张三",
			// 	"pass"=>"123",
			// 	"age"=>18,
			// ];

			// $code=db("user")->insert($data);

			$data=[
				[
					"name"=>"张三1",
					"pass"=>"123",
					"age"=>15,
				],
				[
					"name"=>"张三2",
					"pass"=>"123",
					"age"=>19,
				],

			];

			$code=db("user")->insertAll($data);

			$data=[
				"name"=>"张三",
				"pass"=>"123",
				"age"=>18,
			];

			$code=db("user")->insertGetId($data);



		echo Db::getLastSql();

		dump($code);
	}

	// 更新数据

	public function update(){

		// // 修改数据

		// 	$code=Db::table("user")->where("id",">",'60')->update(["pass"=>"qwe","age"=>2]);
		// 	// UPDATE `user` SET `pass`='qwe',`age`=2 WHERE `id` > 60
		// 	// 返回值 影响行数 

		// 	$code=Db::table("user")->update(['age'=>52,"id"=>62]);
		// 	// UPDATE `user` SET `age`=52 WHERE `id` = 62

		// 	$code=Db::table("user")->where("id",73)->setField("pass",'abc');
		// 	// UPDATE `user` SET `pass`='abc' WHERE `id` = 73

		// // 设置自增

		// 	$code=Db::table("user")->where("id",63)->setInc("age");
		// 	// UPDATE `user` SET `age`=age+1 WHERE `id` = 63

		// // 设置自减
		// 	// UPDATE `user` SET `age`=age-1 WHERE `id` = 62
		// 	$code=Db::table("user")->where("id",62)->setDec("age");

		// 	$code=Db::table("user")->where("id",62)->setDec("age",3);
		// 	// UPDATE `user` SET `age`=age-3 WHERE `id` = 62

		// 使用助手函数

		$code=db("user")->where("id",66)->setInc("age");
		// UPDATE `user` SET `age`=age+1 WHERE `id` = 66

		$code=db("user")->where("id",63)->setDec("age",3);
		// UPDATE `user` SET `age`=age-3 WHERE `id` = 63
		echo Db::getLastSql();
		dump($code);
	}

	// 删除数据

	public function delete(){

		// 删除一条数据

		$code=Db::table("user")->where("id","71")->delete();

		$code=Db::table("user")->delete(70);

		// 删除多条数据

		$code=Db::table("user")->where("id in(51,54,55)")->delete();

		$code=Db::table("user")->delete([62,63,66]);

		// 删除区间数据

		$code=Db::table("user")->where("id>40 and id<45")->delete();
		// DELETE FROM `user` WHERE ( id>40 and id<45 )
		dump($code);

		echo Db::getLastSql();
		

	}


	// 事务机制

	public function shiwu(){

		// 自动控制事务

		// Db::transaction(function(){

		// 	// 删除一条数据

		// 	Db::table("user")->delete(40);

		// 	// 删除数据

		// 	Db::table("user")->deletes();
		// });

		// 手动控制事务

			// // 开启事务

			// Db::startTrans();

			// // 事务

			// try{

			// 	// 删除数据id 31

			// 	$a=Db::table("user")->delete(31);

			// 	// 判断是否删除成功

			// 	if (!$a) {

			// 		throw new \Exception("删除id 31 数据没有成功");
			// 	}

			// 	// 删除不存在的数据 id 32

			// 	$b=Db::table("user")->delete(32);

			// 	// 判断是否删除成功

			// 	if (!$b) {

			// 		throw new \Exception("删除id 32 数据没有成功");
			// 	}


			// 	// 执行提交操作

			// 	Db::commit();


			// }catch(\Exception $e){

			// 	// 回滚事务

			// 	Db::rollback();

			// 	dump($e->getMessage());
			// }

		// 开启事务
		Db::startTrans();

		// 删除数据 33

		$a=Db::table("user")->delete(33);
		// 删除数据 34
		$b=Db::table("user")->delete(34);

		// 判断条件

		if ($a && $b) {
			// 提交事务
			Db::commit();
		}else{
			// 回滚事务
			Db::rollback();
		}

	}

	// 视图查询

	public function views(){

		// 视图查询

		$data=Db::view("goods","id,name,price")
				->view("type",'name tname',"type.id=goods.cid")
				->select();

		// SELECT `goods`.`id`,`goods`.`name`,`goods`.`price`,type.name tname FROM `goods` `goods` INNER JOIN `type` `type` ON `type`.`id`=`goods`.`cid`

		$data=Db::view("goods","id,name,price")
				->view("type",'name tname',"type.id=goods.cid","left")
				->select();

		// SELECT `goods`.`id`,`goods`.`name`,`goods`.`price`,type.name tname FROM `goods` `goods` LEFT JOIN `type` `type` ON `type`.`id`=`goods`.`cid`
				
		echo Db::getLastSql();

		dump($data);


	}



}


 ?>