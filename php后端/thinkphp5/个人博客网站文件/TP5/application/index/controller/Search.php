<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\DB;
class Search extends Base
{
    public function index()
    {
        $keywords=input('keywords');
        if($keywords)
        {
            $map['title']=['like','%'.$keywords.'%'];
            $search=db('article')->where($map)->order('id desc')->paginate($listRows=3,$simple=false,$config=[
                'query'=>array('keywords'=>$keywords),
            ]);
            $this->assign(array(
                'search'=>$search,
                'keywords'=>$keywords,
            ));
        }else{
            $this->assign(array(
                'search'=>null,
                'keywords'=>'暂无数据',
            ));
        }
        return $this->fetch("search");//加载模板
    }

}
