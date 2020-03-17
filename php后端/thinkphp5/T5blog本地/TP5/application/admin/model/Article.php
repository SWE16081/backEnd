<?php
namespace app\admin\model;
use think\Model;

class Article extends Model
{
    //一对多关联
    public function Cate()
    {
        return $this->belongsTo('cate','cateid');
    }
}
