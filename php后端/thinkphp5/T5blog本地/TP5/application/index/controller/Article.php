<?php
namespace app\index\controller;
use app\index\controller\Base;
class Article extends Base
{
    public function index()
    {
        $articleid=input('articleid');
        $article=db('article')->find($articleid);
        $relate=$this->relate($article['keywords'],$article['id']);

        db('article')->where('id',$articleid)->setInc('click');
        $cates=db('cate')->where('cateid',$article['cateid'])->find();
        $recommend=db('article')->where(array('cateid'=>$cates['cateid'],'state'=>1))->limit(8)->select();
        $this->assign(array(
            'article'=>$article,
            'cates'=>$cates,
            'recommend'=>$recommend,
            'relate'=>$relate,
        ));
   return $this->fetch("article");//加载模板

    }

    public function relate($keywords,$id)
    {
        $arr = explode(',', $keywords);
        static $relate = array();
        foreach ($arr as $key => $v) {
            $map['keywords'] = ['like', '%' . $v . '%'];//查询与关键词相近的文章
            $map['id'] = ['neq', $id];
            $rel = db('article')->where($map)->order('id desc')->limit(8)->select();//二维数组
            $relate = array_merge($relate, $rel);//合并数组
        }
        //去重复数据
        if ($relate) {//有与关键字相似的文章
            $relate = arr_unique($relate);
            return $relate;
        }


    }


}
