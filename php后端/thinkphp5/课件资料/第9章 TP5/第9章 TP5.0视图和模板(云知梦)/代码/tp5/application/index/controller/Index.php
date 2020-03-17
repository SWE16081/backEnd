<?php
namespace app\index\controller;

use think\Controller;

use think\View;

use think\Db;
class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    // 加载页面

    public function jiazai(){
    	// 继承系统控制器类

    		// return $this->fetch();

    	// 使用助手函数

    		// return view();

    	// 使用view类 (不建议)

    		$view=new View();

    		return $view->fetch();

    }

    // 模板赋值

    public function fuzhi(){

    	$name="云知梦";
    	$city="太原";

    	// 变量分配

    		// 控制器类中的assign方法

	    		// $this->assign('name',$name);
	    		// $this->assign('city',$city);

    			// 加载页面
    			// return view();

    		// 通过fetch方法

    			// return $this->fetch('',['name'=>$name,'city'=>$city]);

    		// 助手函数

    			// return view('',['name'=>$name,'city'=>'西安']);

    		// 对象赋值
    			$this->view->name="浩哥";
    			$this->view->city="临汾";

    			return view();

    	
    }

    // 引入联想首页

    public function lianxiang(){

    	// fetch 方法
    	return $this->fetch('',[],['__HOMES__'=>'/static/home/public','__ABC__'=>'abcdefg']);
    	// view 函数
    	return view('',[],['__HOMES__'=>'/static/home/public','__ABC__'=>'abcdefg']);
    }

    // 模板渲染

    public function xuanran(){

    	// 默认加载当前模块 当前控制器 当前方法对应的页面
    		// return $this->fetch();

    	// 指定加载页面
    		// 加载当前模块 当前控制器下的 用户定义页面
    		// return $this->fetch('jiazai');

    		// 加载当前模块 User控制器 jiazai页面
    		return $this->fetch('User/jiazai');
    }

    // 模板标签

    public function tags(){
    	// 分配字符串

    		$this->assign("str","TP5.0 非常简单非常适合初学者");

    	// 分配数组

    		$data=[
    			'name'=>'张三',
    			'age'=>18,
    			'sex'=>'妖'
    		];

    		$this->assign("data",$data);

    	// 分配时间

    		$this->assign('time',time());
    		$this->assign('pass','123');

    		$this->assign('status',3);

    		$this->assign('a',10);
    		$this->assign('b',5);

    	return $this->fetch();
    }


    // 系统变量

    public function sys(){


    	return $this->fetch();
    }

    // 页面包含

    public function baohan(){

    	return $this->fetch();
    }

    // volist 


    public function volist(){

        // 查询数据

        $data=Db::table("user")->select();

        // 分配数据

        $this->assign('data',$data);
        $this->assign('empty',"<b>数据不能为空</b>");

        // 加载页面
        return $this->fetch();
    }

    // foreach

    public function foreachs(){

        // 查询数据

        $data=Db::table("user")->select();

        // 分配数据

        $this->assign('data',$data);
        $this->assign('a',10);
        $this->assign('b',20);
        $this->assign('week',7);


        $type=Db::table("type")->select();

        foreach ($type as $key => &$value) {
            # code...

            $value['goods']=Db::table("goods")->where("cid = $value[id]")->select();
        }

        $this->assign('type',$type);


        // 加载页面
        return $this->fetch();
    }

}
