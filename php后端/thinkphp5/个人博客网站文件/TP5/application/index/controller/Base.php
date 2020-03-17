<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
        //执行right()方法
        $this->right();
        //top上显示栏目的数据（很多地方都可以用到
        $cateres=db('cate')->order('cateid asc')->select();
        $tags=db('tags')->order('id desc')->select();
        $this->assign(array(
            'cateres'=>$cateres,
            'tags'=>$tags,
        ));

    }
    //index右侧搜索栏的公用数据
    public function right()
    {
        $click=db('article')->order('click desc')->select();
        $recommend=db('article')->where('state',1)->order('click desc')->limit(8)->select();
        $this->assign(array(
           'click'=>$click,
            'recommend'=>$recommend,
        ));
    }


}
