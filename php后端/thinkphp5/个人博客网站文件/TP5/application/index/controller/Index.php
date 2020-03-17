<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
        //查询当前栏目下的文章
        $article=db('article')->order('id desc')->paginate(3);
        $this->assign('article',$article);
        return $this->fetch();//加载模板
    }


}
