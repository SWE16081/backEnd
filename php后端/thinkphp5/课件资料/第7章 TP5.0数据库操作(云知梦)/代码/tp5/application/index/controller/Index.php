<?php
namespace app\index\controller;

// 导入系统的Db类

use think\Db;
class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }


    // 使用配置文件链接数据库

    public function data(){

    	// 实例化系统数据库类

    	$DB=new Db;

    	// 查询数据

    	// $data=$DB::table("user")->select();


    	// 使用sql语句

    	$data=$DB::query("select * from user");

    	dump($data);
    }

    // 使用方法配置数据库链接

    public function data1(){

    	echo "使用方法配置数据库链接";

    	// 使用数组

    	$Db=Db::connect([
    			// 数据库类型
    			'type'            => 'mysql',
    			// 服务器地址
    			'hostname'        => '127.0.0.1',
    			// 数据库名
    			'database'        => 'yzmedu2',
    			// 用户名
    			'username'        => 'root',
    			// 密码
    			'password'        => '123456789',
    			// 端口
    			'hostport'        => '3306',

    		]);

    	$data=$Db->table("abc")->select();

    	// dump($data);

    	$Db=Db::connect("mysql://root:123456789@127.0.0.1:3306/yzmedu#utf8");
    	// 数据库类型://用户名:密码@数据库地址:数据库端口/数据库名#字符集


    	$data=$Db->table("user")->select();

    	dump($data);

    }


    // 使用模型定义链接

    public function data2(){

    	echo "使用模型链接数据库";

    	$user=new \app\index\model\User();

    	dump($user::all());

    }
}
