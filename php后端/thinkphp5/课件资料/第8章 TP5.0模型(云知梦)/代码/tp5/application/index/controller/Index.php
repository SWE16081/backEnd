<?php
namespace app\index\controller;

// 导入用户定义的数据模型类

use app\index\model\User;

// 导入loader类

use \think\Loader;
class Index
{
    public function index()
    {
    	// 实例化数据模型
    		// 数据库名和模型名一致
	    	$user=new \app\index\model\User;
	    	// 获取对象一条数据
	    	dump($user::get(1)->toArray());

	    	// 数据库名和模型名不一致
	    	$users=new \app\index\model\Users;

	    	dump($users::get(1)->toArray());

	    	// 数据名(yzm_user) 模型名(YzmUser)

	    	$yzmuser=new \app\index\model\YzmUser;

	    	dump($yzmuser::get(1)->toArray());

    }

    // 模型的实例化

    public function get(){
    	// 调用静态方法

    	$res=User::get(1);
    	dump($res->toArray());

    	// 实例化数据模型

    	$user=new User();
    	$res=$user::get(2);
    	dump($res->toArray());

    	// 使用loader

    	$user=Loader::model("user");
    	$res=$user::get(3);
    	dump($res->toArray());

    	// 使用助手函数

    	$user=model("user");

    	$res=$user::get(4);

    	dump($res->toArray());
    }

    // 获取单条数据

    public function getOne(){

    	// get方法
	    	// 使用数字
	    	$res=User::get(1); // 默认主键
	    	// 使用数组
	    	$res=User::get(["name"=>'yzmedu3']);  // 默认查找用户名

	    	// 使用闭包函数
	    	$res=User::get(function($query){
	    		$query->where("id",15);
	    	});
	    // find方法

	    	$res=User::where("id",13)->find();

    	dump($res->toArray());
    }

    // 查询多条数据

    public function getAll(){

    	// all
    		// 所有数据
    		$res=User::all();

    		// 字符串
    		$res=User::all("1,2,3");

    		// 数组
    		$res=User::all([5,6,7]);

    		// 数组

    		$res=User::all(['pass'=>'123']);

    		// 闭包

    		$res=User::all(function($query){
    			$query->where("pass","123")
    				->whereOr("pass","456")
    				->order("id","desc");
    		});

    	// select

			$res=User::select();
			$res=User::limit(2)->select();

    	foreach ($res as $key => $value) {
    		dump($value->toArray());
    	}
    }

    // 获取值

    public function getValue(){
    	// 获取某个值
    	$res=User::where("id",5)->value("name");

    	// 获取某列值

    	$res=User::column("name","id");

    	dump($res);
    }

    // 动态查询

    public function dong(){
    	// 动态查询
    	// getBy字段名
    	$res=User::getByAge('44');
    	dump($res->toArray());
    }

    // 增加数据

    public function add(){
		
    	// $user=new User();
    	// 设置属性
	    	// $user->name="yzmedu21";
	    	// $user->pass="abc";
	    	// $user->age=18;

    	// 通过data方法

    		// $user->data([
    		// 	"name"=>"yzmedu22",
    		// 	"age"=>"22",
    		// 	"pass"=>"qwe",
    		// 	]);

    	// 实例化

    	// 	$user=new User([
    	// 		"name"=>"yzmedu23",
    	// 		"pass"=>'zxc',
    	// 		"age"=>20,
    	// 		"sex"=>1
    	// 		]);
    	// // 返回影响行数
    	// // $user->allowField(true)->save();
    	// $user->allowField(['name','age'])->save();

    	// echo $user->id;

    	// 增加多条数据

    	// $user=new User();

    	// $list=[
    	// 	['name'=>"yzmedu33","age"=>33],
    	// 	['name'=>"yzmedu34","age"=>34]

    	// ];

    	// $user->saveAll($list);


    	$user=User::create([
    		"name"=>"yzmedu35",
    		"age"=>35
    		]);
    }


    // 删除操作

    public function delete(){

        // 删除数据

            // $user=User::get(1);
            // 返回影响行数
            // dump($user->delete());

            // 删除主键2
            $user=User::destroy(2);

            // 删除主键3,4,5
            $user=User::destroy("3,4,5");
            $user=User::destroy([6,7,8]);

            // 删除name

            $user=User::destroy(['name'=>"yzmedu23"]);

            // 删除多个条件

            $user=User::destroy(['name'=>'yzmedu33','age'=>33]);

            // 使用闭包

            $user=User::destroy(function($query){

                $query->where("id","<","15");
            });

            // 删除数据

            $user=User::where("id",">","19")->delete();

            // 获取最后执行的sql语句

            echo User::getLastSql();
            dump($user);
    }

    // 更新操作

    public function update(){

        // 设置字段更新数据

            // $user=User::get(15);

            // $user->age=19;

            // $res=$user->save();

        // 直接数组修改

            // $user=new User;

            // $res=$user->save(
            //     [
            //         "pass"=>"qweasd",
            //         "age"=>16,
                    
            //     ],["id"=>16]);

        // 修改数据

            $_POST['name']="yzmedu55";
            $_POST['pass']="pass55";
            $_POST['age']="55";
            $_POST['sex']="nan";
            $_POST['id']=17;

            $user=new User;

            $res=$user->allowField(['name','pass','age'])->save($_POST,['id'=>17]);

        // 批量更新


            $data=[
                ['id'=>15,'name'=>"abc",'pass'=>456],
                ['id'=>17,'name'=>"abc",'pass'=>456],
            ];

            $user=new User;

            $res=$user->saveAll($data);

            echo User::getLastSql();

        // 更新操作

            $user=new User;

            $res=$user->where("id",'>','17')->update(['age'=>18]);

            $res=User::where("id","<","18")->update(['pass'=>'zxc']);

        // 闭包更新数据

            $user=new User;

            $res=$user->save(['name'=>'yunzhimeng'],function($query){
                $query->where("id","15");
            });




        dump($res);
    }

    // 数据统计


    public function tongji(){
        // 统计数据条数
        $tot=User::count();

        dump($tot);

        // 条件判断
        $tot=User::where("age",">",18)->count();
        dump($tot);

        // 统计最大值

        $max=User::max('age');

        dump($max);

        // 统计最小值

        $min=User::min("age");

        dump($min);

        // 平均值
        $avg=User::avg('age');

        dump($avg);

        // 求和
        $sum=User::sum('age');
        dump($sum);

    }

    // 获取器的学习

    public function getSex(){

        // 获取ID为15 的数据

        $user=User::get(17);

        // 经过获取器的操作
        dump($user->toArray()); 

        dump($user->sex);

        // 不经过获取器处理

        dump($user->getData());
    }

    // 修改器

    public function setPass(){

        // 修改 ID 为15 的密码

        $user=new User();

        // $res=$user->where("id",15)->update(['pass'=>'456']);

        $res=$user->save(['pass'=>'456'],['id'=>15]);

        dump($res);
    }


    // 自动完成

    public function auto(){
        // 修改器
            // 数据赋值的时候自动进行转换处理

            // 实例化User数据模型
            // $user=new User();

            // // 插入数据

            // $res=$user->save(['name'=>'yunzhimeng','pass'=>'123']);

            // echo md5('123');

            // dump($res);

        // 自动完成

            // 没有手动赋值的情况下进行手动处理

            // 实例化User数据模型
            $user=new User();

            // 插入数据

            // $res=$user->save(['name'=>'yunzhimeng','pass'=>'123']);

            // 修改数据

            $res=$user->save(['name'=>"one"],['id'=>17]);
    }

    // 软删除


    public function ruan(){

        // 删除数据

        // $res=User::destroy(15);

        // 获取数据

        // $res=User::get(15);

        // 直接删除数据

        // $res=User::destroy(14,true);

        // $user=new User();

        // $res=$user->where("id",'5')->delete();

        // 读取软删除数据

        // $res=User::withTrashed()->find(15);
        // $res=User::withTrashed()->select();

        // 仅仅读取软删除数据
        $res=User::onlyTrashed()->select();
        $res=User::onlyTrashed()->find(1);

        dump($res);
    }


}
