<?php

namespace app\shop\controller;
use app\admin\model\OperationModel;
use app\Repository\BaseRepository;
use app\shop\model\GoodsModel;
use app\shop\model\GoodsSaleModel;
use app\shop\model\GoodsSpePriceModel;
use app\shop\model\GoodsTypeModel;
use think\Controller;
class Goods extends Controller
{
    protected  $goodsModel;
    protected  $goodsSaleModel;
    public function __construct(GoodsModel $goodsModel,GoodsSaleModel $goodsSaleModel)
    {
        $this->goodsModel=$goodsModel;
        $this->goodsSaleModel=$goodsSaleModel;
    }
//
    /**
     * 商品种类添加
     * @return \think\response\Json
     * @author xichao<952002423@qq.com>
     * @create 2020/6/16
     */
    public function goodsTypeAdd()
    {
        //获取数据
        $data=input('post.');
        //验证数据
        //特殊字符验证
        $rule=[
            'goodsTypeName' => 'require|between:1,20',
        ];
        $validate=parameterValidation($rule,$data['goodsTypeName']);
        if(!$validate){
            return json(msg(400,'',$validate['msg']));
        }else{
            $type=[
                'goodsTypeName'=>$data['goodsTypeName'],
                'create_time'=>date("Y-m-d H:i:s"),
                'remark'=>$data['remark'],
            ];
            $goodsTypeModel=new GoodsTypeModel();
            //开启事务
            $goodsTypeModel->startTrans();
            //插入数据
            $result=$goodsTypeModel->goodsTypeAdd($type);
            if($result===false){
                //回滚
                $goodsTypeModel->rollback();
                return json(msg(400,'','添加失败'));
            }
            //写入操作日志
            $operContent = '商品种类管理:'.$data['goodsTypeName'].'添加人:'.$data['operationName'].'添加人ID:'.$data['operationId'].'添加场馆ID:'.$data['operationorgId'];
            $log = [
                'tableName' => '商品种类表',
                'userId' => $data['operationId'],
                'orgId' => $data['operationorgId'],
                'userName' => $data['operationName'],
                'operAction' => '商品种类添加',
                'operResult' => 200,
                'operContent' => $operContent,
                'type' => 1,
                'userPhone'=>$data['userPhone'],
                'operationPage'=>'商品管理页面',
                'operationButton'=>'商品类型添加'
            ];
            $operationModel = new OperationModel();
            $operationModel->startTrans();
            $res = $operationModel->operationAdd($log);
            //写入日志错误回滚
            if($res === false){
                $operationModel->rollBack();
                $goodsTypeModel->rollBack();
                return json(msg(400,'','添加失败'));
            }
            //提交事务
            $operationModel->commit();
            $goodsTypeModel->commit();
            return json(msg(200,'','添加成功'));

        }

    }

    /**
     * 商品种类查询
     * @return \think\response\Json
     * @author xichao<952002423@qq.com>
     * @create 2020/6/16
     */
    public function goodsTypeSel()
    {
        $goodsTypeModel=new GoodsTypeModel();
        $result=$goodsTypeModel->goodsTypeSel();
        if($result){
            return json(msg(200,$result,'获取商品种类列表成功'));
        }else{
            return json(msg(400,'','获取商品种类列表失败'));
        }

    }

    /**
     * 商品添加
     * @return \think\response\Json
     * @author xichao<952002423@qq.com>
     *
     */
    public function goodsAdd()
    {
        //获取数据
        $data=input('post.');
        //验证商品数据
        $rule=[
            'goodsTypeId' => 'require|number',
            'goodsName' => 'require|between:1,20',
            'picture' => 'require',
            'price' => 'require|number',
            'commoditySpecifications' => 'require|number',
            'commodityBarCode' => 'require|number',
            'saleStatus' => 'require|number',
        ];
        $validate=parameterValidation($rule,$data);
        if(!$validate){
            return json(msg(400,'',$validate['msg']));
        }
        $goodsSpePriceModel=new GoodsSpePriceModel();
        $goodsSaleModel=new GoodsSaleModel();
        $goodsModel=new GoodsModel();

        //开启事务
        $goodsSpePriceModel->startTrans();
        $goodsSaleModel->startTrans();
        $goodsModel->startTrans();
        $goods=[
            'goodsTypeId' => $data['goodsTypeId'],
            'goodsName' => $data['goodsName'],
            'picture' => $data['picture'],
            'price' => $data['price'],
            'isGift' => $data['isGift'],
            'isGiftApproval' =>$data['isGiftApproval'],
            'commoditySpecifications' => $data['commoditySpecifications'],
            'commodityBarCode' => $data['commodityBarCode'],
            'saleStatus' => $data['saleStatus'],
            'create_time'=>date('Y-m-d h:i:s ')
        ];
        $goodsid=$goodsModel->goodsAdd($goods);
        //插入数据失败回滚
        if($goodsid===false){
            $goodsModel->rollback();
            return json(msg(400,'','添加商品失败'));
        }
        else{
            //添加可售门店数据
            $orgId=explode(',',$data['orgId']);
            $sale_sum=0;
            for($i=0;$i<count($orgId);$i++){
                $sale=[
                    'orgId'=>$orgId[$i],
                    'goodsId'=>$goodsid,
                    'create_time'=>date('Y-m-d h:i:s ')
                ];
                $sale_result=$goodsSaleModel->goodsSaleAdd($sale);
                if($sale_result===false){
                    $goodsModel->rollback();
                    $goodsSaleModel->rollback();
                    return json(msg(400,'','添加可售门店失败'));
                }else{
                    $sale_sum++;
                }
            }
            if($sale_sum!=count($orgId)){
                return json(msg(400,'','添加可售门店失败'));
            }else{
                //判断是否选择特殊门店
                if($data['isSpecial']==1)
                {
                    //特殊门店，门店id 价格id用逗号隔开,
                    $special_orgId=explode(',',$data['special_orgId']);//指定门店id
                    $special_price=explode(',',$data['special_price']);
                    if(count($special_price)==0){
                        return json(msg(400,'','特殊门店价格未填写'));
                    }
                    $sum=0;
                    //过滤没填写价格的门店
                    for($i=0;$i<count($special_price);$i++){
                        $spe_data=[
                            'orgId'=>$special_orgId[$i],
                            'price'=>$special_price[$i],
                            'goodsId'=>$goodsid
                        ];
                        $spe_price_result=$goodsSpePriceModel->goodsSpePriceAdd($spe_data);
                        if($spe_price_result===false){
                            //插入数据失败回滚
                            $goodsSpePriceModel->rollback();
                            $goodsModel->rollback();
                            $goodsSaleModel->rollback();
                            return json(msg(400,'','添加特殊价格门店失败'));
                        }else{
                            $sum++;
                        }
                    }
                    //添加成功
                    if($sum==count($special_price)){
                        //写入日志
                        $operContent = '商品管理:'.$data['goodsName'].'添加人:'.$data['operationName'].'添加人ID:'.$data['operationId'].'添加商品ID:'.$goodsid;
                        $log = [
                            'tableName' => '商品表',
                            'userId' => $data['operationId'],
                            'orgId' => $data['operationorgId'],
                            'userName' => $data['operationName'],
                            'operAction' => '商品添加',
                            'operResult' => 200,
                            'operContent' => $operContent,
                            'type' => 1,
                            'userPhone'=>$data['userPhone'],
                            'operationPage'=>'商品管理页面',
                            'operationButton'=>'商品添加'
                        ];
                        $operationModel = new OperationModel();
                        $operationModel->startTrans();
                        $res = $operationModel->operationAdd($log);
                        //写入日志失败回滚
                        if($res===false){
                            $goodsSpePriceModel->rollback();
                            $goodsModel->rollback();
                            $goodsSaleModel->rollback();
                            $operationModel->rollback();
                            return json(msg(400,'','添加商品失败'));
                        }else{
                            $operationModel->commit();
                            $goodsModel->commit();
                            $goodsSaleModel->commit();
                            $goodsSpePriceModel->commit();
                            return json(msg(200,'','添加商品成功'));
                        }
                    }else{
                        $goodsSpePriceModel->rollback();
                        $goodsModel->rollback();
                        $goodsSaleModel->rollback();
                        return json(msg(400,'','添加特殊价格门店失败'));
                    }
                }else{
                    //写入日志
                    $operContent = '商品管理:'.$data['goodsName'].'添加人:'.$data['operationName'].'添加人ID:'.$data['operationId'].'添加场馆ID:'.$data['operationorgId'];
                    $log = [
                        'tableName' => '商品表',
                        'userId' => $data['operationId'],
                        'orgId' => $data['operationorgId'],
                        'userName' => $data['operationName'],
                        'operAction' => '商品添加',
                        'operResult' => 200,
                        'operContent' => $operContent,
                        'type' => 1,
                        'userPhone'=>$data['userPhone'],
                        'operationPage'=>'商品管理页面',
                        'operationButton'=>'商品添加'
                    ];
                    $operationModel = new OperationModel();
                    $operationModel->startTrans();
                    $res = $operationModel->operationAdd($log);
                    //写入日志失败回滚
                    if($res===false){
                        $goodsModel->rollback();
                        $goodsSpePriceModel->rollback();
                        $goodsSaleModel->rollback();
                        $operationModel->rollback();
                        return json(msg(400,'','添加商品失败'));
                    }
                    $operationModel->commit();
                    $goodsModel->commit();
                    $goodsSaleModel->commit();
                    $goodsSpePriceModel->commit();
                    return json(msg(200,'','添加商品成功'));
                }
            }
        }
    }

    /**
     * 商品删除
     * @return \think\response\Json
     * @author xichao<952002423@qq.com>
     * @create 2020/6/17
     */
    public function goodsDel(){
        $data=input('post.');
        $goodsModel=new GoodsModel();
        $goodsSpePriceModel=new GoodsSpePriceModel();
        $goodsSaleModel=new GoodsSaleModel();
        //开启事务
        $goodsModel->startTrans();
        $goodsSpePriceModel->startTrans();
        $goodsSaleModel->startTrans();
        $result=$goodsModel->goodsDel($data['id']);
        if($result===false){
            $goodsModel->rollback();
            return json(msg('400','','删除商品失败'));
        }
        $price_result=$goodsSpePriceModel->goodsSpePriceDel($data['id']);
        if($price_result===false){
            $goodsModel->rollback();
            $goodsSpePriceModel->rollback();
            return json(msg('400','','删除特殊门店价格失败'));
        }
        $sale_result=$goodsSaleModel->goodsSaleDel($data['id']);

        if($sale_result===false){
            $goodsModel->rollback();
            $goodsSpePriceModel->rollback();
            $goodsSaleModel->rollback();
            return json(msg('400','','删除可售门店失败'));
        }
        //写入日志
        $operContent = '商品管理:'.'删除人:'.$data['operationName'].'删除人ID:'.$data['operationId']."删除商品ID".$data['id'];
        $log = [
            'tableName' => '商品表',
            'userId' => $data['operationId'],
            'orgId' => $data['operationorgId'],
            'userName' => $data['operationName'],
            'operAction' => '商品删除',
            'operResult' => 200,
            'operContent' => $operContent,
            'type' => 1,
            'userPhone'=>$data['userPhone'],
            'operationPage'=>'商品管理页面',
            'operationButton'=>'商品删除'
        ];
        $operationModel = new OperationModel();
        $operationModel->startTrans();
        $res = $operationModel->operationAdd($log);
        //写入日志失败回滚
        if($res===false){
            $goodsModel->rollback();
            $goodsSpePriceModel->rollback();
            $goodsSaleModel->rollback();
            $operationModel->rollback();
            return json(msg(400,'','删除商品失败'));
        }else{
            $operationModel->commit();
            $goodsModel->commit();
            $goodsSpePriceModel->commit();
            $goodsSaleModel->commit();
            return json(msg(200,'','删除商品成功'));
        }

    }

    /**
     * 商品状态更新
     * @return \think\response\Json
     * @author xichao<952002423@qq.com>
     * @create 2020/6/17
     */
    public function goodsStatusChange(){
        $data=input('post.');
        $goodsModel=new GoodsModel();
        //开启事务
        $goodsModel->startTrans();
        $result=$goodsModel->goodsStatusChange($data['status'],$data['id']);
        if($result===false){
            $goodsModel->rollback();
            return json(msg(400,'','更新商品状态失败'));
        }
        //写入日志
        $operContent = '商品管理:'.'更新人:'.$data['operationName'].'更新人ID:'.$data['operationId']."更新商品ID".$data['id'];
        $log = [
            'tableName' => '商品表',
            'userId' => $data['operationId'],
            'orgId' => $data['operationorgId'],
            'userName' => $data['operationName'],
            'operAction' => '商品删除',
            'operResult' => 200,
            'operContent' => $operContent,
            'type' => 1,
            'userPhone'=>$data['userPhone'],
            'operationPage'=>'商品管理页面',
            'operationButton'=>'商品删除'
        ];
        $operationModel = new OperationModel();
        $operationModel->startTrans();
        $res = $operationModel->operationAdd($log);
        //写入日志失败回滚
        if($res===false){
            $goodsModel->rollback();
            $operationModel->rollback();
            return json(msg(400,'','更新商品状态失败'));
        }else{
            $operationModel->commit();
            $goodsModel->commit();
            return json(msg(200,'','更新商品状态成功'));
        }

    }

    /**
     * 商品详情
     * @return \think\response\Json
     * @author xichao<952002423@qq.com>
     * @create 2020/6/17
     */
    public function goodsDetail(){
        $data=input('post.');
        $goodsModel=new GoodsModel();
        $goodsSaleModel=new GoodsSaleModel();
        $goodsSpePriceModel=new GoodsSpePriceModel();
        $result=$goodsModel->goodsSelById($data['id']);
        $sale_result=$goodsSaleModel->goodsSaleById($data['id']);
        $res=[
            'goods'=>$result,
            'sale_org'=>$sale_result
        ];
        if($result&&$sale_result){
            //开启特殊门店
            if($result[0]['isSpecial']===1){
                $price_result=$goodsSpePriceModel->goodsSpePriceById($data['id']);
                $res['price_org']=$price_result;
            }
            return json(msg(200,$res,'获取商品详情成功'));
        }else{
            return json(msg(400,'','获取商品详情失败'));
        }
    }

    /**
     * 编辑商品
     * @author xichao<952002423@qq.com>
     * @create 2020/6/17
     */
    public function goodsUpdate(){
        //获取数据
        $data=input('post.');
        //验证商品数据
        $rule=[
            'goodsTypeId' => 'require|number',
            'goodsName' => 'require|between:1,20',
            'picture' => 'require',
            'price' => 'require|number',
            'commoditySpecifications' => 'require|number',
            'commodityBarCode' => 'require|number',
            'saleStatus' => 'require|number',
        ];
        $validate=parameterValidation($rule,$data);
        if(!$validate){
            return json(msg(400,'',$validate['msg']));
        }
        $goodsSpePriceModel=new GoodsSpePriceModel();
        $goodsSaleModel=new GoodsSaleModel();
        $goodsModel=new GoodsModel();

        //开启事务
        $goodsSpePriceModel->startTrans();
        $goodsSaleModel->startTrans();
        $goodsModel->startTrans();
        $goods=[
            'goodsTypeId' => $data['goodsTypeId'],
            'goodsName' => $data['goodsName'],
            'picture' => $data['picture'],
            'price' => $data['price'],
            'isGift' => $data['isGift'],
            'isGiftApproval' =>$data['isGiftApproval'],
            'commoditySpecifications' => $data['commoditySpecifications'],
            'commodityBarCode' => $data['commodityBarCode'],
            'saleStatus' => $data['saleStatus'],
            'create_time'=>date('Y-m-d h:i:s ')
        ];
        $result=$goodsModel->goodsUpdate($goods,$data['id']);
        //更新数据失败回滚
        if($result===false){
            $goodsModel->rollback();
            return json(msg(400,'','更新商品失败'));
        }
        else{
            //删除原有可售门店数据
            $sale_del_result=$goodsSaleModel->goodsSaleDel($data['id']);
            if($sale_del_result===false){
                $goodsModel->rollback();
                $goodsSaleModel->rollback();
                return json(msg(400,'','更新可售门店失败'));
            }
            //更新可售门店数据
            $orgId=explode(',',$data['orgId']);//指定的可售门店门店ID
            $sale_sum=0;
            for($i=0;$i<count($orgId);$i++){
                $sale=[
                    'orgId'=>$orgId[$i],
                    'goodsId'=>$data['id'],
                    'create_time'=>date('Y-m-d h:i:s ')
                ];
                $sale_result=$goodsSaleModel->goodsSaleAdd($sale);
                if($sale_result===false){
                    $goodsModel->rollback();
                    $goodsSaleModel->rollback();
                    return json(msg(400,'','更新可售门店失败'));
                }else{
                    $sale_sum++;
                }
            }
            if($sale_sum!=count($orgId)){
                return json(msg(400,'','更新可售门店失败'));
            }else{
                //判断是否选择特殊门店
                if($data['isSpecial']==1)
                {
                    //删除特殊门店数据
                    $price_del_result=$goodsSpePriceModel->goodsSpePriceDel($data['id']);
                    if($price_del_result===false){
                        $goodsModel->rollback();
                        $goodsSaleModel->rollback();
                        $goodsSpePriceModel->rollback();
                        return json(msg(400,'','更新特殊价格门店失败'));
                    }
                    //特殊门店，门店id 价格id用逗号隔开
                    $special_orgId=explode(',',$data['special_orgId']);//指定特殊门店的
                    $special_price=explode(',',$data['special_price']);
                    if(count($special_price)==0){
                        return json(msg(400,'','特殊门店价格未填写'));
                    }
                    $sum=0;
                    for($i=0;$i<count($special_price);$i++){
                        $spe_data=[
                            'orgId'=>$special_orgId[$i],
                            'price'=>$special_price[$i],
                            'goodsId'=>$data['id']
                        ];
                        $spe_price_result=$goodsSpePriceModel->goodsSpePriceAdd($spe_data);
                        if($spe_price_result===false){
                            //插入数据失败回滚
                            $goodsSpePriceModel->rollback();
                            $goodsModel->rollback();
                            $goodsSaleModel->rollback();
                            return json(msg(400,'','编辑特殊价格门店失败'));
                        }else{
                            $sum++;
                        }
                    }
                    //添加成功
                    if($sum==count($special_price)){
                        //写入日志
                        $operContent = '商品管理:'.$data['goodsName'].'编辑人:'.$data['operationName'].'编辑人ID:'.$data['operationId'].'商品ID:'.$data['id'];
                        $log = [
                            'tableName' => '商品表',
                            'userId' => $data['operationId'],
                            'orgId' => $data['operationorgId'],
                            'userName' => $data['operationName'],
                            'operAction' => '商品编辑',
                            'operResult' => 200,
                            'operContent' => $operContent,
                            'type' => 1,
                            'userPhone'=>$data['userPhone'],
                            'operationPage'=>'商品管理页面',
                            'operationButton'=>'商品编辑'
                        ];
                        $operationModel = new OperationModel();
                        $operationModel->startTrans();
                        $res = $operationModel->operationAdd($log);
                        //写入日志失败回滚
                        if($res===false){
                            $goodsSpePriceModel->rollback();
                            $goodsModel->rollback();
                            $goodsSaleModel->rollback();
                            $operationModel->rollback();
                            return json(msg(400,'','编辑商品失败'));
                        }else{
                            $operationModel->commit();
                            $goodsModel->commit();
                            $goodsSaleModel->commit();
                            $goodsSpePriceModel->commit();
                            return json(msg(200,'','编辑商品成功'));
                        }
                    }else{
                        $goodsSpePriceModel->rollback();
                        $goodsModel->rollback();
                        $goodsSaleModel->rollback();
                        return json(msg(400,'','编辑特殊价格门店失败'));
                    }
                }else{
                    //写入日志
                    $operContent = '商品管理:'.'编辑人:'.$data['operationName'].'编辑人ID:'.$data['operationId'].'商品ID:'.$data['id'];
                    $log = [
                        'tableName' => '商品表',
                        'userId' => $data['operationId'],
                        'orgId' => $data['operationorgId'],
                        'userName' => $data['operationName'],
                        'operAction' => '商品编辑',
                        'operResult' => 200,
                        'operContent' => $operContent,
                        'type' => 1,
                        'userPhone'=>$data['userPhone'],
                        'operationPage'=>'商品管理页面',
                        'operationButton'=>'商品编辑'
                    ];
                    $operationModel = new OperationModel();
                    $operationModel->startTrans();
                    $res = $operationModel->operationAdd($log);
                    //写入日志失败回滚
                    if($res===false){
                        $goodsModel->rollback();
                        $goodsSaleModel->rollback();
                        $operationModel->rollback();
                        return json(msg(400,'','编辑商品失败'));
                    }
                    $operationModel->commit();
                    $goodsModel->commit();
                    $goodsSaleModel->commit();
                    return json(msg(200,'','编辑商品成功'));
                }
            }
        }
    }

    /**
     * 商品条件查询
     * @author xichao<952002423@qq.com>
     * @create 2020/6/17
     */
    public function goodsSel(){
        $data=input('post.');
        $goodsModel=new GoodsModel();
        $result=$goodsModel->goodsSelPage($data['page']);
        return json(msg(200,$result,''));
    }

    public function goodsSelTest(){
//        $goodsModel=new GoodsModel();
        $where=['goodsTypeId'=>10];
        $clounm='id,goodsTypeId,goodsName,picture';
        $size=2;
        $currentPage=2;
//        $res=$this->model->mySelect($where,$clounm);
//        $res=$this->goodsModel->mySelect($where,$clounm);
        $res=$this->goodsSaleModel->mySelect();
        $data=[
            'goodsTypeId'=>1,
            'goodsName'=>2,
            'picture'=>2,
            'price'=>2,
            'isGift'=>2,
            'isGiftApproval'=>2,
            'commoditySpecifications'=>2,
            'commodityBarCode'=>2,
            'saleStatus'=>2,
            'create_time'=>2,
            'isSpecial'=>2,
        ];
//        $res=$goodsModel->myInsert($data);
//        $data=['goodsTypeId'=>10,'goodsName'=>3];
//        $res=$this->goodsModel->myInsertGetId($data);
        return json(msg(200,$res,'123'));
    }
}