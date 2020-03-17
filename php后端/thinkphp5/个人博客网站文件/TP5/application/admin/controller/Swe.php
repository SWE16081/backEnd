<?php
namespace app\admin\controller;
use think\Controller;//引入空间类元素//引用类库
//use app\admin\controller\Base;
use app\admin\model\Swe as AdminModel;
class Swe extends Controller
{

    public function lst()
    {
        //分页输出列表，每页显示三条数据
        $list=AdminModel::paginate(3);//分页同时取得数据库数据
        dump($list);die;
        $this->assign('list',$list);//$list数组被分配到模板中,第一个参数为名称，第二个参数为值
           return  $this->fetch();//加载模板
    }


}
