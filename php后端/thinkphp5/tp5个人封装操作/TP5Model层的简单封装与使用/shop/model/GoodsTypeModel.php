<?php

/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/16
 * Time: 10:05
 */
namespace app\shop\model;
use think\Model;
class GoodsTypeModel extends Model
{
    protected $connection="database.shop";
    protected $name="t_goods_type";
    //添加商品种类
    public function goodsTypeAdd($data){
        $res=$this->save($data);
        return $res;
    }
    //查询商品种类
    public function goodsTypeSel(){
        $res=$this->field('id','goodsTypeName')->select();
        return $res;
    }
}