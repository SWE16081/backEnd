<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\DB;
class Cate extends Base
{
    public function index()
    {
        $cateid=input('cateid');
        //查询当前栏目名称
        $cates=db('cate')->find($cateid);
        $this->assign('cates',$cates);
//查询当前栏目下的文章
        $article=db('article')->where('cateid',$cateid)->paginate(3);
        $this->assign('article',$article);
        return $this->fetch("list");//加载模板
    }

}
