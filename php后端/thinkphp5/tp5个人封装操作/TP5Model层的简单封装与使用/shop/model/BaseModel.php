<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/18
 * Time: 9:02
 */

namespace app\shop\model;


use think\Model;

class BaseModel extends Model
{

    /**
     * 通用查询
     * @author xichao<952002423@qq.com>
     *
     */
    public  function mySelect($where=[],$cloumns="*"){
        $res=$this->where($where)->field($cloumns)->select();
        return $res;
    }

    /**
     * 通用分页查询
     * @author xichao<952002423@qq.com>
     * @create ${YEAR}-${MONTH}-${DAY} ${TIME}
     */
    public function myPageSelect($where=[],$cloumns="*",$size,$pge){
        $res=$this->where($where)->field($cloumns)->limit($size)->page($pge)->select();
        return $res;
    }

    /**
     * 通用插入
     * @author xichao<952002423@qq.com>
     */
    public function myInsert($data){
        $res=$this->insert($data);
        return $res;
    }

    /**
     *  通用插入返回主键
     * @param $data
     * @return int|string
     * @author xichao<952002423@qq.com>
     */
    public function myInsertGetId($data){
        $res=$this->insertGetId($data);
        return $res;
    }

    /**
     * 通用更新
     * @author xichao<952002423@qq.com>
     */
    public function myUpdate($where=[],$data){
        $res=$this->where($where)->update($data);
        return $res;
    }

    /**
     * 通用删除
     * @param array $where
     * @author xichao<952002423@qq.com>
     */
    public function  myDelete($where){
        $res=$this->where($where)->delete();
        return $res;
    }
}