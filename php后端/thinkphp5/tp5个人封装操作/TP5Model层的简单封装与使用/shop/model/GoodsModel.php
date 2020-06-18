<?php

/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/16
 * Time: 9:59
 */
namespace app\shop\model;
use think\Model;
class GoodsModel extends BaseModel
{
    protected $connection="database.shop";
    protected $name="t_goods";

    //添加商品
    public function goodsAdd($data){
        $res=$this->insertGetId($data);
        return $res;
    }
    //查询商品
    public function goodsSel(){
        $res=$this->select();
        return $res;
    }
    //删除商品
    public function goodsDel($id){
        $res=$this
            ->where('id',$id)
            ->delete();
        return $res;
    }
    //修改售卖状态
    public function goodsStatusChange($status,$id){
        $res=$this
            ->where('id',$id)
            ->update(['saleStatus'=>$status]);
        return $res;
    }
    //按id查询商品
    public function goodsSelById($id){
        $res=$this
            ->field('goodsName,picture,price,isGift,isGiftApproval,
            commoditySpecifications,commodityBarCode,saleStatus,isSpecial')
            ->where('id',$id)
            ->select();
        return $res;
    }

    //编辑商品
    public function goodsUpdate($data,$id){
        $res=$this
            ->where('id',$id)
            ->update($data);
        return $res;
    }
    //分页查询
    public function goodsSelPage($page=5){
        $res=$this
            ->limit(5)
            ->page(2)->select();
        return $res;
    }



}