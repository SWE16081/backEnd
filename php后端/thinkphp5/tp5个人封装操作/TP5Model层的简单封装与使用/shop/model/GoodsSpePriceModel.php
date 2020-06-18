<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/16
 * Time: 14:50
 */

namespace app\shop\model;

use think\Model;
class GoodsSpePriceModel extends Model
{
    protected $connection="database.shop";
    protected $name="t_goods_special_org_price";
    //添加特殊商品门店价格
    public function goodsSpePriceAdd($data){
        $res=$this->insert($data);
        return $res;
    }
    //删除特殊商品门店价格
    public function goodsSpePriceDel($id){
        $res=$this
            ->where('goodsId',$id)
            ->delete();
        return $res;
    }
    //按goodsId查询特殊商品门店价格
    public function goodsSpePriceById($id){
        $res=$this
            ->field('orgId,price')
            ->where('goodsId',$id)
            ->select();
        return $res;
    }
}