<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/16
 * Time: 15:27
 */

namespace app\shop\model;


use think\Model;

class GoodsSaleModel extends BaseModel
{
    protected $connection="database.shop";
    protected $name="t_goods_sale_org";
    //添加可售门店
    public function goodsSaleAdd($data){
        $res=$this->insert($data);
        return $res;
    }
    //删除可售门店
    public function goodsSaleDel($id){
        $res=$this
            ->where('goodsId',$id)
            ->delete();
        return $res;
    }
    //按goodsId查询可售门店
    public function goodsSaleById($id){
        $res=$this
            ->field('id,orgId')
            ->where('goodsId',$id)
            ->select();
        return $res;
    }
    //更新可售门店
    public function goodsSaleUpdate($data,$goodsId){
        $res=$this
            ->where('goodsId',$goodsId)
            ->update($data);
        return $res;
    }


}